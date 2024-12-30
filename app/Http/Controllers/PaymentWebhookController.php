<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Order;
use App\Mail\OrderEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\RestaurantPhoneNumber;

class PaymentWebhookController extends Controller
{
    
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
}
