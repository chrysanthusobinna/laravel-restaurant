<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Models\LiveChatScript;
use App\Models\RestaurantAddress;
use App\Models\SocialMediaHandle;
use App\Models\RestaurantPhoneNumber;
use App\Models\RestaurantWorkingHour;
use GetCountryCurrency\CountryCurrencyAPI;

class MainSiteController extends Controller
{
    // Share live chat script with all views
    public function __construct()
    {
        $liveChatScript = LiveChatScript::latest()->first();

        $firstRestaurantAddress = RestaurantAddress::first();
        $firstRestaurantPhoneNumber = RestaurantPhoneNumber::first();
        $socialMediaHandles = SocialMediaHandle::orderBy('id', 'desc')->get();
        
        $whatsAppNumber = RestaurantPhoneNumber::where('use_whatsapp', 1)->first();
        
        view()->share([
            'liveChatScript' => $liveChatScript,
            'whatsAppNumber' => $whatsAppNumber,
            'socialMediaHandles' => $socialMediaHandles,
            'firstRestaurantAddress' => $firstRestaurantAddress,
            'firstRestaurantPhoneNumber' => $firstRestaurantPhoneNumber,           
        ]);
    }
    

    public function home()
    {

        //$country 	=	"United Kingdom"; 
       // $currencyData = (new CountryCurrencyAPI())->fetchCurrencyData($country);
       $menus = Menu::all();

        return view('main-site.index', compact('menus'));
    }

    public function about()
    {
        return view('main-site.about');
    }
    public function contact()
    {
        $addresses = RestaurantAddress::all();
        $phoneNumbers = RestaurantPhoneNumber::all();
        $workingHours = RestaurantWorkingHour::all();
    
        return view('main-site.contact', [ 'addresses' => $addresses, 'phoneNumbers' => $phoneNumbers, 'workingHours' => $workingHours, ]);
    }
    

    public function menu()
    {
        return view('main-site.menu');
    }

    public function menuItem($id)
    {
        $menu = Menu::with(['category'])->findOrFail($id);
    
        // Fetch 5 random related menus (same category as the current menu)
        $relatedMenus = Menu::where('id', '!=', $id)->inRandomOrder()->limit(5)->get();
    
        return view('main-site.menu-item', compact('menu', 'relatedMenus'));
    }
    

    public function cart()
    {
        return view('main-site.cart');
    }

    public function checkout()
    {
        return view('main-site.checkout');
    }

    public function blog()
    {
        return view('main-site.blog');
    }

    public function blogDetails()
    {
        return view('main-site.blog-details');
    }

    public function login()
    {
        return view('main-site.login');
    }


    public function privacyPolicy()
    {
        return view('main-site.privacy-policy');
    }
    public function termsConditions()
    {
        return view('main-site.terms-conditions');
    }

    
    
}
