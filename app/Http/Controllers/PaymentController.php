<?php

namespace App\Http\Controllers;

use Exception;
use Stripe\Charge;
use Stripe\Stripe;
use App\Models\Order;
use App\Mail\OrderEmail;
use App\Models\Customer;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\RestaurantPhoneNumber;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Traits\CartTrait;
use App\Http\Controllers\Traits\ViewSharedDataTrait;

class PaymentController extends Controller
{
    use CartTrait;
    use ViewSharedDataTrait;

    public function __construct()
    {
        $this->initializeSharedLogic();

    }

    


     public function payment()
    {

        //run all required session checks
        $this->runAllChecks();

        // Retrieve customer details from the session
        $customerDetails = Session::get('customer_details', []);

        // Retrieve cart items from session
        $cart_items = session()->get('customer', []);

        // Retrieve Delivery Details
        $deliveryDetails = session('delivery_details');
        $delivery_fee = $deliveryDetails['delivery_fee'];
    
        
        // Retrieve order no. from session
        $order_no = session('order_no');

 
        if (Order::where('order_no', $order_no)->exists()) {
            return redirect() ->route('menu')->withErrors('The order number already exists. Please try again.');
        }



        // Initialize the line_items array
        $line_items = [];

        // Loop through the cart items to populate line_items
        foreach ($cart_items as $cart_item) {
            $line_items[] = [
                'price_data' => [
                    'currency' => 'gbp',
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
                    'currency' => 'gbp',
                    'product_data' => [
                        'name' => 'Delivery Fee',
                    ],
                    'unit_amount' => $delivery_fee * 100, // Convert to cents
                ],
                'quantity' => 1, // Delivery fee is a one-time charge
            ];
        }

        // Set Stripe secret key
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            // Get the site URL
            $SITE_URL = env('APP_URL');

            // Create a Stripe Checkout session
            $checkout_session = \Stripe\Checkout\Session::create([
                'line_items' => $line_items,
                'mode' => 'payment',
                'customer_email' => $customerDetails['email'],
                'metadata' => [
                    'order_no' => $order_no,
                    'name' => $customerDetails['name'],
                    'phone' => $customerDetails['phone_number'],
                    'address' => $customerDetails['address'],
                    'city' => $customerDetails['city'],
                    'state' => $customerDetails['state'],
                    'postcode' => $customerDetails['postcode'],
                ],

                'success_url' => $SITE_URL . 'payment-success/?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => $SITE_URL . 'payment-cancel/',
            ]);

            // Redirect the user to the Stripe Checkout session URL
            return redirect($checkout_session->url);
        } catch (\Exception $e) {
            $error_msg  =  $e->getMessage();
            return redirect()->route('menu')->withErrors($error_msg);            
        }
    }

    public function paymentCancel()
    {
        return view('main-site.payment-cancel');
    }

 
    public function paymentSuccess(Request $request)
    {
        //run all required session checks
        $this->runAllChecks();

        $customerDetails = Session::get('customer_details', []);

        // Set Stripe secret key
        Stripe::setApiKey(config('services.stripe.secret'));
    
        // Retrieve the session ID from the request
        $session_id = $request->query('session_id');

        // Retrieve the order number from the session
        $order_no = session('order_no');

        // Retrieve Delivery Details from the session
        $deliveryDetails = session('delivery_details');
        $delivery_fee = $deliveryDetails['delivery_fee'];
        $delivery_distance = $deliveryDetails['distance_in_miles'];
        $price_per_mile= $deliveryDetails['price_per_mile'];
    
        if ($session_id) {
            try {
                    $cart = session()->get($this->cartkey, []);

                    // Retrieve the checkout session
                    $checkout_session = \Stripe\Checkout\Session::retrieve($session_id);

                    $orderNoFromStripe = $checkout_session->metadata->order_no;

                    // Verify the order number
                    if ($order_no == $orderNoFromStripe) {

                    // Retrieve the customer and payment details
                    $customer_email = $checkout_session->customer_email;
                    $metadata = $checkout_session->metadata;
        


                    $totalPrice = array_reduce($cart, function ($carry, $item) {
                        return $carry + ($item['price'] * $item['quantity']);
                    }, 0);


                    // Create the customer
                    $customer = Customer::create([
                        'name' =>  $metadata->name,
                        'email' =>  $customer_email ,
                        'phone_number' => $metadata->phone,
                        'address' => $metadata->address . " ".$metadata->city." ".$metadata->state." ".$metadata->postcode,
                    ]);



                    // Create a new order
                    $order = Order::create([
                        'customer_id' => $customer->id,
                        'order_no' => $metadata->order_no,
                        'order_type' => 'online',
                        'created_by_user_id' => null,
                        'updated_by_user_id' => null,
                        'total_price' => $totalPrice,
                        'status' => 'pending',
                        'payment_method' => "STRIPE",
                        'additional_info' => $customerDetails['additional_info'],
                        'delivery_fee' => $delivery_fee,
                        'delivery_distance' => $delivery_distance,
                        'price_per_mile' => $price_per_mile,
                        
                    ]);

                    if ($order) {
                        // Create order items using the relationship
                        foreach ($cart as $item) {
                            $order->orderItems()->create([
                                'menu_name' => $item['name'],  
                                'quantity' => $item['quantity'],
                                'subtotal' => $item['price'] * $item['quantity'],
                            ]);
                        }
                    }
                    

 
                    // Send the email
                    try {
                        Mail::to($customerDetails['email'])->send(new OrderEmail(
                            $cart,
                            $customerDetails['name'],
                            $customerDetails['email'],
                            $order_no,
                            $delivery_fee,
                            $totalPrice,
                            config('site.email'),
                            RestaurantPhoneNumber::first() ? RestaurantPhoneNumber::first()->phone_number : null
                        ));
                    } catch (Exception $e) {
                        Log::error('Order email failed to send: ' . $e->getMessage());
                    }
                    

                    // Clear the session
                    session()->forget([
                        $this->cartkey, 
                        'customer_details', 
                        'delivery_details', 
                        'order_no'
                    ]);
                    
    
                    return view('main-site.payment-success', ['customer_email' => $customer_email,  'metadata' => $metadata, ]);


                } else {
                    return redirect()->route('menu')->withErrors('Order verification failed');
                }

            } catch (\Exception $e) {
                $error_msg  =  $e->getMessage();
                return redirect()->route('menu')->withErrors($error_msg);
            }
        } else {
            return redirect()->route('menu')->withErrors('Session ID not found. Please contact support.');
        }
    }
    


    
    // Check if a session key exists and the cart is not empty, otherwise redirect with an error message
    protected function checkCart()
    {
 
        if (!session()->has($this->cartkey) || empty(session()->get($this->cartkey))) {
            return redirect()->route('menu')->withErrors('Your cart is empty. Please add items to your cart before checking out.')->send();
        }
    }

    // Check if a session customer_details exists, otherwise redirect with an error message
    protected function checkCustomerDetails()
    {
        if (!session()->has('customer_details')) {
            return redirect()->route('menu')->withErrors('We could not retrieve your customer details. Please try again or contact support if the issue persists.')->send();
        }
    }

    // Check if a session delivery_details exists, otherwise redirect with an error message
    protected function checkDeliveryDetails()
    {
        if (!session()->has('delivery_details')) {
            return redirect()->route('menu')->withErrors('We could not retrieve your delivery details. Please try again or contact support if the issue persists.')->send();
        }
    }

    // Check if a session order_no exists, otherwise redirect with an error message
    protected function checkOrderNo()
    {
        if (!session()->has('order_no')) {
            //return redirect()->route('menu')->withErrors('We could not retrieve your order number. Please try again or contact support if the issue persists.')->send();
            return redirect()->route('menu')->send();
        }
    }


    // Call all checks at once
    protected function runAllChecks()
    {
        $this->checkCart();
        $this->checkCustomerDetails();
        $this->checkDeliveryDetails();
        $this->checkOrderNo();
    }
}
