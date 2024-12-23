<?php

namespace App\Http\Controllers;

use Stripe\Charge;
use Stripe\Stripe;
use App\Models\Order;
use App\Models\Customer;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
     public function payment($cartkey="customer")
    {

        // Check if the session contains the cart key
        if (!session()->has($cartkey)) {
            return redirect()->route('home')->withErrors('Your cart is empty. Please add items to your cart before checking out.');
        }

        // Check if the session contains the customer details
        if (!session()->has('customer_details')) {
            return redirect()->route('home')->withErrors('Error Occusred');
        }

        // Retrieve customer details from the session
        $customerDetails = Session::get('customer_details', []);

        // Retrieve cart items from session
        $cart_items = session()->get('customer', []);

        // Retrieve order no. from session
        $order_no = session('order_no');



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
            return redirect()->route('home')->withErrors($error_msg);            
        }
    }

    public function paymentCancel()
    {
        return view('main-site.payment-cancel');
    }

 
    public function paymentSuccess(Request $request)
    {
                   
        // Set Stripe secret key
        Stripe::setApiKey(config('services.stripe.secret'));
    
        // Retrieve the session ID from the request
        $session_id = $request->query('session_id');

        $cartkey = "customer";

        // Retrieve the order number from the session
        $order_no = session('order_no');
    
        if ($session_id) {
            try {
                    // Retrieve the checkout session
                    $checkout_session = \Stripe\Checkout\Session::retrieve($session_id);

                    $orderNoFromStripe = $checkout_session->metadata->order_no;

                    // Verify the order number
                    if ($order_no == $orderNoFromStripe) {
                        // Process order confirmation

                    // Retrieve the customer and payment details
                    $customer_email = $checkout_session->customer_email;
                    $metadata = $checkout_session->metadata;
        
                    //  confirm the user and payment details
            
                    $cart = session()->get($cartkey, []);
                    if (empty($cart)) {
                        return back()->with('error', 'Cart is empty!');

                    }

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

                    // Clear the cart
                    session()->forget($request->cartkey);
    
                    return view('main-site.payment-success', ['customer_email' => $customer_email,  'metadata' => $metadata, ]);
/*
                    return response()->json([
      
                        'order_no' => $order_no ?? null, // Ensure the variable exists
                        'orderNoFromStripe' => $orderNoFromStripe ?? null, // Ensure the variable exists
                    ]);
                    */

                } else {
                    return redirect()->route('home')->withErrors('Order verification failed');
                }

            } catch (\Exception $e) {
                $error_msg  =  $e->getMessage();
                return redirect()->route('home')->withErrors($error_msg);
            }
        } else {
            return redirect()->route('home')->withErrors('Session ID not found. Please contact support.');
        }
    }
    

    public function processPayment(Request $request)
    {
        try {
            // Set Stripe secret key
            Stripe::setApiKey(config('services.stripe.secret'));

            // Create a payment intent
            $paymentIntent = PaymentIntent::create([
                'amount' => $request->amount * 100, // Amount in cents
                'currency' => 'usd',
                'payment_method_types' => ['card'],
            ]);

            return response()->json([
                'clientSecret' => $paymentIntent->client_secret,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



}
