<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Models\OrderSettings;
use App\Models\LiveChatScript;
use App\Models\CompanyAddress;
use App\Models\SocialMediaHandle;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Models\RestaurantPhoneNumber;
use App\Models\RestaurantWorkingHour;
use App\Http\Requests\PhoneNumberRequest;
use App\Http\Requests\WorkingHourRequest;
use App\Http\Requests\LiveChatScriptRequest;
use App\Http\Requests\SocialMediaHandleRequest;
use App\Http\Controllers\Traits\SanitizesInputTrait;
use App\Http\Controllers\Traits\AdminViewSharedDataTrait;

class GeneralSettingsController extends Controller
{
    use AdminViewSharedDataTrait;
    use SanitizesInputTrait;


    public function __construct()
    {
        $this->shareAdminViewData();
        
    }
    
    public function index()
    {
        $addresses = CompanyAddress::all();
        $phoneNumbers = RestaurantPhoneNumber::all();
        $workingHours = RestaurantWorkingHour::all();
        $socialMediaHandles = SocialMediaHandle::all();
        $script = LiveChatScript::latest()->first();
        $order_settings = OrderSettings::latest()->first();

        $site_settings = SiteSetting::firstOrCreate([], [
            'country' => config('site.country'),
            'currency_symbol' => config('site.currency_symbol'),
            'currency_code' => config('site.currency_code'),
        ]);
        $countries = Country::orderBy('name')->get();



        return view('admin.general-settings', compact('addresses', 'phoneNumbers', 'workingHours','socialMediaHandles','script','order_settings', 'countries'));
    }

    // Restaurant Phone Number CRUD
    public function storePhoneNumber(PhoneNumberRequest $request)
    {

        // If 'use_whatsapp' is checked, set all others to 0 first
        if ($request->has('use_whatsapp') && $request->use_whatsapp == 1) {
            RestaurantPhoneNumber::where('use_whatsapp', 1)->update(['use_whatsapp' => 0]);
        }
    
        RestaurantPhoneNumber::create([
            'phone_number' => $request->phone_number,
            'use_whatsapp' => $request->has('use_whatsapp') ? 1 : 0,
        ]);
    
        return back()->with('success', 'Phone number added successfully.');
    }
    
    
    

    public function updatePhoneNumber(PhoneNumberRequest $request, $id)
    {
    
        $phoneNumber = RestaurantPhoneNumber::findOrFail($id);
    
        // If 'use_whatsapp' is checked, set all others to 0 first
        if ($request->has('use_whatsapp') && $request->use_whatsapp == 1) {
            RestaurantPhoneNumber::where('use_whatsapp', 1)->update(['use_whatsapp' => 0]);
        }
    
        $phoneNumber->update([
            'phone_number' => $request->phone_number,
            'use_whatsapp' => $request->has('use_whatsapp') ? 1 : 0,
        ]);
    
        return back()->with('success', 'Phone number updated successfully.');
    }
    
    

    public function deletePhoneNumber($id)
    {
        RestaurantPhoneNumber::findOrFail($id)->delete();
        return back()->with('success', 'Phone number deleted successfully.');
    }
    

    // Restaurant Address CRUD
    public function storeAddress(AddressRequest $request)
    {
        CompanyAddress::create([
            'street'      => $request->line1,
            'city'        => $request->city,
            'state'       => $request->state,
            'postal_code' => $request->postal_code,
            'country'     => $request->country,
            'latitude'    => $request->latitude,
            'longitude'   => $request->longitude,
        ]);

        return back()->with('success', 'Address added successfully.');
    }

    public function updateAddress(AddressRequest $request, $id)
    {
        $address = CompanyAddress::findOrFail($id);

        $address->update([
            'street'      => $request->line1,
            'city'        => $request->city,
            'state'       => $request->state,
            'postal_code' => $request->postal_code,
            'country'     => $request->country,
            'latitude'    => $request->latitude,
            'longitude'   => $request->longitude,
        ]);

        return back()->with('success', 'Address updated successfully.');
    }

    public function deleteAddress($id)
    {
        CompanyAddress::findOrFail($id)->delete();

        return back()->with('success', 'Address deleted successfully.');
    }



    // social media handles CRUD
    public function storeSocialMediaHandle(SocialMediaHandleRequest $request)
    {
        SocialMediaHandle::create($request->all());
        return back()->with('success', 'Social media handle added successfully.');
    }
    
    public function updateSocialMediaHandle(SocialMediaHandleRequest $request, $id)
    {
        $socialMediaHandle = SocialMediaHandle::findOrFail($id);
        $socialMediaHandle->update($request->all());
    
        return back()->with('success', 'Social media handle updated successfully.');
    }
    

    public function deleteSocialMediaHandle($id)
    {
        $socialMediaHandle = SocialMediaHandle::findOrFail($id);
        $socialMediaHandle->delete();
    
        return back()->with('success', 'Social media handle deleted successfully.');
    }
    
 



    // Restaurant Working Hour CRUD
    public function storeWorkingHour(WorkingHourRequest $request)
    {
        RestaurantWorkingHour::create(['working_hours' => $request->working_hours]);
        return back()->with('success', 'Working hour added successfully.');
    }
    

    public function updateWorkingHour(WorkingHourRequest $request, $id)
    {
        $workingHour = RestaurantWorkingHour::findOrFail($id);
        $workingHour->update(['working_hours' => $request->working_hours]);
        return back()->with('success', 'Working hour updated successfully.');
    }
    
    public function deleteWorkingHour($id)
    {
        RestaurantWorkingHour::findOrFail($id)->delete();
        return back()->with('success', 'Working hour deleted successfully.');
    }
    



    // live chat script CRUD
    public function createLiveChatScript(LiveChatScriptRequest $request)
    {
        $validated = $request->validated();
    
        $validated['script_code'] = $this->sanitizeHtmlContent($validated['script_code']);
    
        LiveChatScript::create($validated);
    
        return redirect()->back()->with('success', 'Live chat script created successfully!');
    }
    


    public function updateLiveChatScript(LiveChatScriptRequest $request, $id)
    {
        $script = LiveChatScript::findOrFail($id);
        $script->update($request->validated());

        return redirect()->back()->with('success', 'Live chat script updated successfully!');
    }


    public function destroyLiveChatScript($id)
    {
        $script = LiveChatScript::findOrFail($id);
        $script->delete();

        return redirect()->back()->with('success', 'Live chat script deleted successfully!');

    }

    public function updateOrderSettings(Request $request)
    {
        $request->validate([
            'price_per_mile' => 'required|numeric',
            'distance_limit_in_miles' => 'required|integer',
        ]);

        $settings = OrderSettings::firstOrNew();
        $settings->price_per_mile = $request->input('price_per_mile');
        $settings->distance_limit_in_miles = $request->input('distance_limit_in_miles');
        $settings->save();

        return redirect()->back()->with('success', 'Order Settings updated successfully!');

    }
 
    public function siteSettings(Request $request)
    {
        $validated = $request->validate([
            'country_id' => 'required|exists:countries,id',
        ]);

        $country = Country::findOrFail($validated['country_id']);

        $siteSetting = SiteSetting::firstOrNew();
        $siteSetting->country         = $country->name;
        $siteSetting->currency_symbol = $this->sanitizeHtmlContent($country->currency_symbol);
        $siteSetting->currency_code   = $country->currency_code;
        $siteSetting->save();

        return redirect()->back()->with('success', 'Site settings saved successfully!');
    }
    
}
