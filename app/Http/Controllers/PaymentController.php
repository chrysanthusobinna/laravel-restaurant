<?php

namespace App\Http\Controllers;

use Exception;
use Stripe\Charge;
use Stripe\Stripe;
use App\Models\Order;
use App\Mail\OrderEmail;
use App\Models\Customer;
use Stripe\PaymentIntent;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Helpers\TwilioHelper;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\RestaurantPhoneNumber;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Traits\CartTrait;
use App\Http\Controllers\Traits\MainSiteViewSharedDataTrait;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PaymentController extends Controller
{
    use CartTrait;
    use MainSiteViewSharedDataTrait;

    public function __construct()
    {
        $this->shareMainSiteViewData();

    }

    


     public function payment()
    {

        //run all required session checks
        $this->runAllChecks();

        // Retrieve customer details from the session
        $customerDetails = Session::get('customer_details', []);

        // Retrieve cart items from session
        $cart_items = session()->get('customer', []);

    
        // Retrieve Delivery Details from the session
        $deliveryDetails = session('delivery_details');
        $delivery_fee = $deliveryDetails['delivery_fee'];
        $delivery_distance = $deliveryDetails['distance_in_miles'];
        $price_per_mile= $deliveryDetails['price_per_mile'];
              
              
        // Retrieve order no. from session
        $order_no = session('order_no');

 
        if (Order::where('order_no', $order_no)->exists()) {
            return redirect() ->route('menu')->withErrors('The order number already exists. Please try again.');
        }

        //Get Site Settings
        $site_settings  =   SiteSetting::latest()->first();
        $currency_code  =   strtolower($site_settings->currency_code);


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

                'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('payment.cancel'),
            ]);

            //PREPARE TO CREATE ORDER
 
            $totalPrice = array_reduce($cart_items, function ($carry, $item) {
                return $carry + ($item['price'] * $item['quantity']);
            }, 0);


            // Create the customer
            $customer = Customer::create([
                'name' =>  $customerDetails['name'],
                'email' =>  $customerDetails['email'] ,
                'phone_number' => $customerDetails['phone_number'],
                'address' => $customerDetails['address'] . " ".$customerDetails['city']." ".$customerDetails['state']." ".$customerDetails['postcode'],
            ]);
   
            // Create a new order
            $order = Order::create([
                'customer_id' => $customer->id,
                'order_no' => $order_no,
                'order_type' => 'online',
                'created_by_user_id' => null,
                'updated_by_user_id' => null,
                'total_price' => $totalPrice,
                'status' => 'pending',
                'status_online_pay' => 'unpaid',
                'session_id' => $checkout_session->id,
                'payment_method' => "STRIPE",
                'additional_info' => $customerDetails['additional_info'],
                'delivery_fee' => $delivery_fee,
                'delivery_distance' => $delivery_distance,
                'price_per_mile' => $price_per_mile,
                
            ]);

            if ($order) {
                // Create order items using the relationship
                foreach ($cart_items as $cart_item) {
                    $order->orderItems()->create([
                        'menu_name' => $cart_item['name'],  
                        'quantity' => $cart_item['quantity'],
                        'subtotal' => $cart_item['price'] * $cart_item['quantity'],
                    ]);
                }
            }
            

            // Redirect the user to the Stripe Checkout session URL
            return redirect($checkout_session->url);

        } catch (Exception $e) {
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

        // Set Stripe secret key
        Stripe::setApiKey(config('services.stripe.secret'));
    
        // Retrieve the session ID from the request
        $session_id = $request->query('session_id');

        // Retrieve the order number from the session
        $order_no = session('order_no');

        if ($session_id) {
            try {

                    // Retrieve the checkout session
                    $checkout_session = \Stripe\Checkout\Session::retrieve($session_id);

                    $order = Order::with(['orderItems', 'customer'])->where('session_id', $checkout_session->id)->first();
                    
                    if (!$order) {
                        throw new NotFoundHttpException();
                        // return redirect()->route('menu')->withErrors('Order verification failed');

                    }

                    if ($order->status_online_pay === 'unpaid') {
                        $order->status_online_pay = 'paid';
                        $order->save();

                        // Send the email
                        try {
                            Mail::to($order->customer->email)->send(new OrderEmail(
                                $order->orderItems,
                                $order->customer->name,
                                $order->customer->email,
                                $order->order_no,
                                $order->delivery_fee,
                                $order->total_price,
                                config('site.email'),
                                RestaurantPhoneNumber::first() ? RestaurantPhoneNumber::first()->phone_number : null
                            ));
                        } catch (Exception $e) {
                            Log::error('Order email failed to send: ' . $e->getMessage());
                        }
                        
                        // send whatsapp message
                        $this->sendWhatsAppNotification($order);    

                        // Clear the session
                        $this->clearOrderSession();
                        
                        return view('main-site.payment-success', compact('order'));                       
                    }
                    elseif ($order->status_online_pay === 'paid') { 

                        // Clear the session
                        $this->clearOrderSession();
                        return view('main-site.payment-success', compact('order'));                       

                    }
 
                    
                    return redirect()->route('menu')->withErrors("There was an issue processing your payment. Please try again.");



            } catch (Exception $e) {
                $error_msg  =  $e->getMessage();
                return redirect()->route('menu')->withErrors($error_msg);
            }
        } else {
            return redirect()->route('menu')->withErrors('Session ID not found!');
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


    public function handleStripeWebhook(Request $request)
    {
        $endpoint_secret =  config('services.stripe.webhookkey');
    
        // Retrieve the raw payload
        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;
    
    
        try {
            // Verify the event signature
            $event = \Stripe\Webhook::constructEvent($payload, $sig_header, $endpoint_secret);
    
            // Handle specific event types
            if ($event->type === 'checkout.session.completed') {
                $session = $event->data->object;  
     
                $order = Order::with(['orderItems', 'customer'])->where('session_id', $session->id)->first();
    
    
                if ($order->status_online_pay === 'unpaid') {
                    $order->status_online_pay = 'paid';
                    $order->save();
    
                    // Send the email
                    try {
                        Mail::to($order->customer->email)->send(new OrderEmail(
                            $order->orderItems,
                            $order->customer->name,
                            $order->customer->email,
                            $order->order_no,
                            $order->delivery_fee,
                            $order->total_price,
                            config('site.email'),
                            RestaurantPhoneNumber::first() ? RestaurantPhoneNumber::first()->phone_number : null
                        ));
                    } catch (Exception $e) {
                        Log::error('Order email failed to send: ' . $e->getMessage());
                    }
                    
                    // send whatsapp message
                    $this->sendWhatsAppNotification($order);                       
                }
     
            }
    
            return response('Webhook handled', 200);
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            Log::error('Invalid payload: ' . $e->getMessage());
            return response('Invalid payload', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            Log::error('Invalid signature: ' . $e->getMessage());
            return response('Invalid signature', 400);
        } catch (Exception $e) {
            // General error
            Log::error('Webhook error: ' . $e->getMessage());
            return response('Webhook error', 500);
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

    protected function clearOrderSession()
    {
        session()->forget([
            'customer',
            'customer_details',
            'delivery_details',
            'order_no'
        ]);
    }

    protected function sendWhatsAppNotification(Order $order)
    {
        try {
            TwilioHelper::sendWhatsAppMessage($order->customer->phone_number, $order->order_no, $order->customer->name);
        } catch (Exception $e) {
            Log::error('Failed to send WhatsApp message: ' . $e->getMessage());
        }
    }    
    
}
