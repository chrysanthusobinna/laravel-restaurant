<?php

namespace App\Http\Controllers\Admin;

use App\Models\LiveChatScript;
use App\Models\RestaurantAddress;
use App\Models\SocialMediaHandle;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Models\RestaurantPhoneNumber;
use App\Models\RestaurantWorkingHour;
use App\Http\Requests\PhoneNumberRequest;
use App\Http\Requests\WorkingHourRequest;
use App\Http\Requests\LiveChatScriptRequest;
use App\Http\Requests\SocialMediaHandleRequest;

class GeneralSettingsController extends Controller
{
    public function index()
    {
        $addresses = RestaurantAddress::all();
        $phoneNumbers = RestaurantPhoneNumber::all();
        $workingHours = RestaurantWorkingHour::all();
        $socialMediaHandles = SocialMediaHandle::all();
        $script = LiveChatScript::latest()->first();




        return view('admin.general-settings', compact('addresses', 'phoneNumbers', 'workingHours','socialMediaHandles','script'));
    }

    // Restaurant Phone Number CRUD
    public function storePhoneNumber(PhoneNumberRequest $request)
    {

        // If 'use_whatsapp' is checked, set all others to 0 first
        if ($request->has('use_whatsapp') && $request->use_whatsapp == 1) {
            RestaurantPhoneNumber::where('use_whatsapp', 1)->update(['use_whatsapp' => 0]);
        }
    
        // Create the new phone number
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
    
        // Update the specific record
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
        RestaurantAddress::create(['address' => $request->address]);
        return back()->with('success', 'Address added successfully.');
    }

    public function updateAddress(AddressRequest $request, $id)
    {
        $address = RestaurantAddress::findOrFail($id);
        $address->update(['address' => $request->address]);
        return back()->with('success', 'Address updated successfully.');
    }
    public function deleteAddress($id)
    {
        RestaurantAddress::findOrFail($id)->delete();
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
        LiveChatScript::create($request->validated());

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

}
