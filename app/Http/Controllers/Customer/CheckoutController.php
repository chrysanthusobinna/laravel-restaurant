<?php

namespace App\Http\Controllers\Customer;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Models\RestaurantAddress;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Traits\CartTrait;
use App\Http\Controllers\Traits\OrderNumberGeneratorTrait;
use App\Http\Controllers\Traits\MainSiteViewSharedDataTrait;

class CheckoutController extends Controller
{
    //
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
        // Optionally confirm the user confirms their details
        $request->validate(['confirm' => 'required|accepted']);

        $data = session(self::SESSION_KEY, []);
        $data['customer_confirmed'] = true;
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

    public function pickupPost(Request $request)
    {
        $request->validate(['pickup_location_id' => 'required']);
        $data = session(self::SESSION_KEY, []);
        $data['pickup_location_id'] = $request->pickup_location_id;
        session([self::SESSION_KEY => $data]);
        return redirect()->route('checkout.payment');
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
        // Either saved address id OR new address fields (UI will handle; validate both)
        $request->validate([
            'mode'               => 'required|in:saved,new',
            'saved_address_id'   => 'required_if:mode,saved|nullable|exists:addresses,id',
            'new.line1'          => 'required_if:mode,new|nullable|string|max:255',
            'new.city'           => 'required_if:mode,new|nullable|string|max:150',
            'new.state'          => 'nullable|string|max:150',
            'new.postal_code'    => 'required_if:mode,new|nullable|string|max:30',
            'new.country'        => 'required_if:mode,new|nullable|string|max:150',
            'billing_same'       => 'nullable|boolean',

            // If billing is different:
            'billing.mode'               => 'nullable|in:saved,new',
            'billing.saved_address_id'   => 'required_if:billing.mode,saved|nullable|exists:addresses,id',
            'billing.new.line1'          => 'required_if:billing.mode,new|nullable|string|max:255',
            'billing.new.city'           => 'required_if:billing.mode,new|nullable|string|max:150',
            'billing.new.state'          => 'nullable|string|max:150',
            'billing.new.postal_code'    => 'required_if:billing.mode,new|nullable|string|max:30',
            'billing.new.country'        => 'required_if:billing.mode,new|nullable|string|max:150',
        ]);

        $data = session(self::SESSION_KEY, []);
        $data['delivery'] = [
            'mode' => $request->mode,
            'saved_address_id' => $request->saved_address_id,
            'new' => $request->input('new'),
            'billing_same' => (bool) $request->billing_same,
            'billing' => $request->input('billing'),
        ];
        session([self::SESSION_KEY => $data]);

        return redirect()->route('checkout.payment');
    }

















        public function checkout()
    {
         $user = Auth::User();
        // Check if the session contains the cart key
        if (!session()->has($this->cartkey)) {
            return redirect()->route('menu')->withErrors('Your cart is empty. Please add items to your cart before checking out.');
        }
    
        // Fetch the cart from the session
        $cart = session()->get($this->cartkey, []);
    
        // Check if the cart is empty
        if (empty($cart)) {
            return redirect()->route('menu')->withErrors('Your cart is empty. Please add items to your cart before checking out.');
        }
    
        // Calculate the subtotal
        $subtotal = array_reduce($cart, function($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        return view('main-site.checkout', compact('user', 'cart', 'subtotal'));
    }
    
    public function proccessCheckout(CustomerDetailsRequest $request)
    {
        // Check if the session contains the cart key
        if (!session()->has($this->cartkey)) {
            return redirect()->route('menu')->withErrors('Your cart is empty. Please add items to your cart before checking out.');
        }


        $order_settings = OrderSettings::firstOrNew();

        if (!$order_settings->exists) {
            // OrderSettings has no data
            return redirect()->route('home')->withErrors('No order settings found.');
        }
        $price_per_mile =   $order_settings->price_per_mile;
        $distance_limit_in_miles = $order_settings->distance_limit_in_miles;

        $restaurant_address = $this->firstRestaurantAddress ?? config('site.address');
        $delivery_address   = $request->address . ' ' . $request->city . ' ' . $request->state . ' ' . $request->postcode;

        // Call the DistanceHelper to get the distance
        $distanceData = DistanceHelper::getDistance($restaurant_address, $delivery_address);

        // Check if there's an error
        if (isset($distanceData['error'])) {
            return back()->withErrors($distanceData['error']);
        }

        $distance_in_miles= $distanceData['value_in_miles'];

        if ($distance_in_miles > $distance_limit_in_miles) {
            $error_message = "We're sorry! We can only deliver within {$distance_limit_in_miles} miles. You can still place your order as a walk-in at our restaurant located at {$restaurant_address}. We look forward to serving you!";
            return back()->withErrors($error_message)->withInput();
        }
        
        $delivery_fee = ceil($price_per_mile * $distance_in_miles * 100) / 100;

        // Store delivery_fee , price_per_mile and distance_in_miles in  session 
        session()->put('delivery_details', [ 'delivery_fee' => $delivery_fee, 'distance_in_miles' => $distance_in_miles,  'price_per_mile' => $price_per_mile, ]);

        // Store the validated data in the session
        Session::put('customer_details', $request->validated());

        // Generate a unique 7-digit order number and store in session
        $order_no = $this->generateOrderNumber();
        session(['order_no' => $order_no]);


        // redirect to payment route
        return redirect()->route('payment');

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
