<?php

namespace App\Helpers;

use Twilio\Rest\Client;

class TwilioHelper
{
    public static function sendWhatsAppMessage($customerPhone, $orderNumber, $customerName)
    {
        // Twilio Credentials from .env
        $sid    = env('TWILIO_SID');
        $token  = env('TWILIO_AUTH_TOKEN');
        $from   = env('TWILIO_WHATSAPP_FROM');
        $to     = env('TWILIO_WHATSAPP_TO');
        
        $twilio = new Client($sid, $token);

        // Construct the message
        $messageBody = "🚨 *New Order Alert!*\n\n";
        $messageBody .= "A new order has been placed on *fcsuya.co.uk* 🛒\n\n";
        $messageBody .= "🆔 *Order Number:* {$orderNumber}\n";
        $messageBody .= "👤 *Customer Name:* {$customerName}\n";
        $messageBody .= "📞 *Customer Phone:* {$customerPhone}\n\n";
        $messageBody .= "Please review and process the order as soon as possible. ✅";


        try {
            // Send WhatsApp Message
            $message = $twilio->messages->create(
                "whatsapp:" . $to,
                [
                    "from" => $from, 
                    "body" => $messageBody
                ]
            );

            return [
                'success' => true,
                'message' => 'WhatsApp message sent successfully!',
                'sid' => $message->sid
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}
