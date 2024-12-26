<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Support\Facades\Auth;
use App\Models\SiteSetting;

trait AdminViewSharedDataTrait
{
    public function shareAdminViewData()
    {
        //logged-in user data 
        $loggedInUser   =    Auth::user();

        // Fetch or create site settings
        $site_settings = SiteSetting::firstOrCreate([], [
            'country' => config('site.country'),
            'currency_symbol' => config('site.currency_symbol'),
            'currency_code' => config('site.currency_code'),
        ]);

     

        view()->share([
            'loggedInUser' => $loggedInUser,
            'site_settings' => $site_settings,
        ]);
   
    }
}
