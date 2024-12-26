<?php

namespace App\Http\Controllers\Traits;

use App\Models\SiteSetting;
use App\Models\LiveChatScript;
use App\Models\RestaurantAddress;
use App\Models\SocialMediaHandle;
use App\Models\RestaurantPhoneNumber;

trait MainSiteViewSharedDataTrait
{
    protected $cartkey;

    public function shareMainSiteViewData()
    {
        $this->cartkey = 'customer';
        
        $liveChatScript = LiveChatScript::latest()->first();
        $firstRestaurantAddress = RestaurantAddress::first();
        $firstRestaurantPhoneNumber = RestaurantPhoneNumber::first();
        $socialMediaHandles = SocialMediaHandle::orderBy('id', 'desc')->get();
        $whatsAppNumber = RestaurantPhoneNumber::where('use_whatsapp', 1)->first();
        $customer_total_cart_items = $this->getTotalItems('customer');

        $site_settings = SiteSetting::firstOrCreate([], [
            'country' => config('site.country'),
            'currency_symbol' => config('site.currency_symbol'),
            'currency_code' => config('site.currency_code'),
        ]);

        

        view()->share([
            'liveChatScript' => $liveChatScript,
            'whatsAppNumber' => $whatsAppNumber,
            'socialMediaHandles' => $socialMediaHandles,
            'firstRestaurantAddress' => $firstRestaurantAddress,
            'firstRestaurantPhoneNumber' => $firstRestaurantPhoneNumber,
            'customer_total_cart_items' => $customer_total_cart_items,
            'site_settings' => $site_settings,
        ]);
    }
}

