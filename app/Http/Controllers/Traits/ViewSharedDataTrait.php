<?php

namespace App\Http\Controllers\Traits;

use App\Models\LiveChatScript;
use App\Models\RestaurantAddress;
use App\Models\RestaurantPhoneNumber;
use App\Models\SocialMediaHandle;

trait ViewSharedDataTrait
{
    protected $cartkey;

    public function initializeSharedLogic()
    {
        $this->cartkey = 'customer';
        
        $liveChatScript = LiveChatScript::latest()->first();
        $firstRestaurantAddress = RestaurantAddress::first();
        $firstRestaurantPhoneNumber = RestaurantPhoneNumber::first();
        $socialMediaHandles = SocialMediaHandle::orderBy('id', 'desc')->get();
        $whatsAppNumber = RestaurantPhoneNumber::where('use_whatsapp', 1)->first();
        $customer_total_cart_items = $this->getTotalItems('customer');

        view()->share([
            'liveChatScript' => $liveChatScript,
            'whatsAppNumber' => $whatsAppNumber,
            'socialMediaHandles' => $socialMediaHandles,
            'firstRestaurantAddress' => $firstRestaurantAddress,
            'firstRestaurantPhoneNumber' => $firstRestaurantPhoneNumber,
            'customer_total_cart_items' => $customer_total_cart_items,
        ]);
    }
}


