<?php

namespace App\Http\Controllers\Customer;

use Stripe\Stripe;
use App\Models\Order;
use App\Models\Address;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Models\OrderSettings;
use App\Helpers\DistanceHelper;
use Illuminate\Validation\Rule;
use App\Models\RestaurantAddress;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Traits\CartTrait;
use App\Http\Controllers\Traits\OrderNumberGeneratorTrait;
use App\Http\Controllers\Traits\MainSiteViewSharedDataTrait;

class CheckoutController extends Controller
{
    use CartTrait;
    use MainSiteViewSharedDataTrait;
    use OrderNumberGeneratorTrait;

    public function __construct()
    {
        $this->shareMainSiteViewData();
    }

    // Session key for wizard data
    const SESSION_KEY = 'checkout';

    public function details()
    {
        $user = Auth::user();
        return view('main-site.checkout-details', compact('user'));
    }

    public function detailsPost(Request $request)
    {
        // confirm the user confirms their details
        $request->validate(['confirm' => 'required|accepted']);

        $order_no = $this->generateOrderNumber();
        $data = session(self::SESSION_KEY, []);
        $data['customer_confirmed'] = true;
        $data['order_no'] = $order_no;

        session([self::SESSION_KEY => $data]);

        return redirect()->route('customer.checkout.fulfilment');
    }

    /** Step 2: Fulfilment choice */
    public function fulfilment()
    {
        $this->guardStep('customer_confirmed');
        $user = Auth::user();
        return view('main-site.checkout-fulfilment', compact('user'));
    }

    public function fulfilmentPost(Request $request)
    {
        $request->validate(['method' => 'required|in:pickup,delivery']);

        $data = session(self::SESSION_KEY, []);
        $data['fulfilment'] = $request->method;
        // reset dependent choices if user changes their mind
        unset($data['pickup_location_id'], $data['delivery']);
        session([self::SESSION_KEY => $data]);

        return $request->method === 'pickup'
            ? redirect()->route('customer.checkout.pickup')
            : redirect()->route('customer.checkout.delivery');
    }

    /** Step 3a: Pickup */
    public function pickup()
    {
        // Ensure customer has completed the previous step
        $this->guardStep('fulfilment', 'pickup');

        // Fetch pickup locations (all restaurant addresses)
        $pickupLocations = RestaurantAddress::all(['id', 'address']);

        // Send them to the view
        return view('main-site.checkout-pickup', compact('pickupLocations'));
    }

    /* step 3a: Pickup POST */
    public function pickupPost(Request $request)
    {
        $request->validate(['pickup_location_id' => 'required']);

        $data = session(self::SESSION_KEY, []);

        // Remove all delivery-specific session data
        unset($data['addresses']);

        // Save pickup location
        $data['pickup_location_id'] = $request->pickup_location_id;

        session([self::SESSION_KEY => $data]);

        return redirect()->route('customer.checkout.review');
    }


    /** Step 3b: Delivery */
    public function delivery()
    {
        $this->guardStep('fulfilment', 'delivery');
        $user = Auth::user();
        $addresses = Address::where('user_id', $user->id)->get();
        return view('main-site.checkout-delivery', compact('addresses'));
    }

    public function deliveryPost(Request $request)
    {
        $user = Auth::user();

        // ---- Base validation ----
        $v = Validator::make($request->all(), [
            'mode' => ['required', Rule::in(['saved','new'])],

            'saved_address_id' => [
                'nullable','integer',
                Rule::exists('addresses','id')->where(fn($q) => $q->where('user_id', $user->id)),
            ],

            // Delivery "new" fields
            'new.line1'       => ['nullable','string','max:255'],
            'new.line2'       => ['nullable','string','max:255'],
            'new.city'        => ['nullable','string','max:150'],
            'new.state'       => ['nullable','string','max:150'],
            'new.postal_code' => ['nullable','string','max:30'],
            'new.country'     => ['nullable','string','max:150'],
        ]);

        // ---- Conditional validation ----
        $v->sometimes('saved_address_id', 'required', fn($input) => $input->mode === 'saved');
        foreach (['new.line1','new.city','new.postal_code','new.country'] as $f) {
            $v->sometimes($f, 'required', fn($input) => $input->mode === 'new');
        }

        $v->validate();

        // ---- Create or resolve delivery address ----
        $deliveryAddressId = null;

        if ($request->mode === 'saved') {
            $deliveryAddressId = (int) $request->saved_address_id;
        } else {
            $delivery = $user->addresses()->create([
                'label'       => 'delivery',
                'street'      => trim(($request->input('new.line1') ?? '') . ($request->filled('new.line2') ? ', '.$request->input('new.line2') : '')),
                'city'        => $request->input('new.city'),
                'state'       => $request->input('new.state'),
                'postal_code' => $request->input('new.postal_code'),
                'country'     => $request->input('new.country'),
                'is_default'  => false,
            ]);
            $deliveryAddressId = $delivery->id;
        }

        // ---- Store only delivery ID in session ----
        $data = session(self::SESSION_KEY, []);
        $data['addresses'] = [
            'delivery_address_id' => $deliveryAddressId,
        ];
        session([self::SESSION_KEY => $data]);

        return redirect()->route('customer.checkout.review');
    }

    /** Step 4: Review */
    public function review()
    {
        $user = Auth::user();


        // Cart checks
        if (!session()->has($this->cartkey)) {
            return redirect()->route('menu')->withErrors('Your cart is empty. Please add items to your cart before checking out.');
        }

        $cart_items = session()->get($this->cartkey, []);

        if (empty($cart_items)) {
            return redirect()->route('menu')->withErrors('Your cart is empty. Please add items to your cart before checking out.');
        }
        
        $order_settings = OrderSettings::first();
        $delivery_fee = 0;

        if (!$order_settings) {
            return redirect()->route('home')->withErrors('No order settings found.');
        }

        $sessionData = session(self::SESSION_KEY, []);

        if (isset($sessionData['addresses']['delivery_address_id'])) {
           

            $price_per_mile          = $order_settings->price_per_mile;
            $distance_limit_in_miles = $order_settings->distance_limit_in_miles;

            $restaurant_address = $this->firstRestaurantAddress ?? config('site.address');

            
            $delivery_address_id = $sessionData['addresses']['delivery_address_id'] ?? null;

            if (!$delivery_address_id) {
                return redirect()->route('customer.checkout.delivery')
                    ->withErrors('Please choose a delivery address first.');
            }

            $delivery_address = $user->addresses()->find($delivery_address_id);

            if (!$delivery_address) {
                return redirect()->route('customer.checkout.delivery')
                    ->withErrors('Selected delivery address was not found.');
            }

            $single_line_address = $delivery_address->full_address;

            // Distance
            $distanceData = DistanceHelper::getDistance($restaurant_address, $single_line_address);

            if (isset($distanceData['error'])) {
                return back()->withErrors($distanceData['error']);
            }

            $distance_in_miles = $distanceData['value_in_miles'];

            if ($distance_in_miles > $distance_limit_in_miles) {
                $error_message = "We're sorry! We can only deliver within {$distance_limit_in_miles} miles. You can still place your order as a walk-in at our restaurant located at {$restaurant_address}. We look forward to serving you!";
                return back()->withErrors($error_message)->withInput();
            }

            // Delivery fee
            $delivery_fee = ceil($price_per_mile * $distance_in_miles * 100) / 100;

            // 🔹 Save delivery pricing into the same checkout session
            $sessionData['delivery'] = [
                'distance_miles' => $distance_in_miles,
                'delivery_fee'   => $delivery_fee,
                'price_per_mile' => $price_per_mile,
            ];
            session([self::SESSION_KEY => $sessionData]);

        }

        $subtotal = array_reduce($cart_items, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        return view('main-site.checkout-review', compact('user', 'cart_items', 'delivery_fee', 'subtotal'));
    }

    public function proccessCheckout(Request $request)
    {
        $user = Auth::user();

        // 1) Ensure there is still a cart
        if (!session()->has($this->cartkey)) {
            return redirect()->route('menu')->withErrors('Your cart is empty. Please add items to your cart before checking out.');
        }

        $cart_items = session()->get($this->cartkey, []);

        if (empty($cart_items)) {
            return redirect()->route('menu')->withErrors('Your cart is empty. Please add items to your cart before checking out.');
        }

        // 2) Pull checkout session data
        $checkout = session(self::SESSION_KEY, []);

        $fulfilment       = $checkout['fulfilment']      ?? 'delivery'; // 'pickup' or 'delivery'
        $addresses        = $checkout['addresses']       ?? [];
        $deliverySession  = $checkout['delivery']        ?? [];
        $order_no         = $checkout['order_no']        ?? null;

        $deliveryAddressId = $addresses['delivery_address_id'] ?? null;
        $pickupLocationId =  $checkout['pickup_location_id'] ?? null;

        $delivery_fee    = $deliverySession['delivery_fee']    ?? 0;
        $distance_miles  = $deliverySession['distance_miles']  ?? null;
        $price_per_mile  = $deliverySession['price_per_mile']  ?? null;

        // 3) Recalculate subtotal
        $subtotal = array_reduce($cart_items, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        $total = $subtotal + $delivery_fee;

        $order = Order::updateOrCreate(
            ['order_no' => $order_no],
            [
                'user_id'            => $user->id,
                'order_type'         => 'online',
                'created_by_user_id' => null,
                'updated_by_user_id' => null,
                'total_price'        => $total,
                'status'             => 'pending',
                'status_online_pay'  => 'unpaid',
                'session_id'         => null,
                'payment_method'     => 'STRIPE',
                'additional_info'    => $request->input('additional_info'),
                'delivery_fee'       => $delivery_fee,
                'delivery_distance'  => $distance_miles,
                'price_per_mile'     => $price_per_mile,
                'delivery_address_id'=> $deliveryAddressId,
                'pickup_address_id'  => $pickupLocationId,
                
                
            ]
        );

        // 6) Attach cart items to the order
        foreach ($cart_items as $item) {
            $order->orderItems()->create([
                'menu_name' => $item['name'],
                'quantity'  => $item['quantity'] ?? '',
                'subtotal'  => $item['price'] * ($item['quantity'] ?? 1),
            ]);
        }

        // Get Site Settings
        $site_settings  = SiteSetting::latest()->first();
        $currency_code  = strtolower($site_settings->currency_code);

        // Initialize the line_items array
        $line_items = [];

        // Loop through the cart items to populate line_items
        foreach ($cart_items as $cart_item) {
            $line_items[] = [
                'price_data' => [
                    'currency' => $currency_code,
                    'product_data' => [
                        'name' => $cart_item['name'],
                    ],
                    'unit_amount' => $cart_item['price'] * 100, // Convert price to cents
                ],
                'quantity' => $cart_item['quantity'],
            ];
        }

        // Add delivery fee in the line_items
        if (isset($delivery_fee)) {
            $line_items[] = [
                'price_data' => [
                    'currency' => $currency_code,
                    'product_data' => [
                        'name' => 'Delivery Fee',
                    ],
                    'unit_amount' => $delivery_fee * 100, // Convert to cents
                ],
                'quantity' => 1,
            ];
        }

        // Set Stripe secret key
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            // Create a Stripe Checkout session
            $checkout_session = \Stripe\Checkout\Session::create([
                'line_items' => $line_items,
                'mode' => 'payment',
                'customer_email' => $user->email,
                'metadata' => [
                    'order_no' => $order->order_no,
                ],
                'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('payment.cancel'),
            ]);

            // Redirect the user to the Stripe Checkout session URL
            return redirect($checkout_session->url);

        } catch (\Exception $e) {
            $error_msg  =  $e->getMessage();
            return redirect()->route('menu')->withErrors($error_msg);
        }
    }

    /** Helpers */
    private function guardStep(string $key, $value = null): void
    {
        $data = session(self::SESSION_KEY, []);
        if (!array_key_exists($key, $data)) {
            redirect()->route('customer.checkout.details')->send();
        }
        if (!is_null($value) && ($data[$key] !== $value)) {
            redirect()->route('customer.checkout.fulfilment')->send();
        }
    }
}
