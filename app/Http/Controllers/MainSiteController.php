<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\LiveChatScript;
use App\Models\RestaurantAddress;
use App\Models\SocialMediaHandle;
use App\Models\RestaurantPhoneNumber;
use App\Models\RestaurantWorkingHour;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Traits\CartTrait;
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

    use CartTrait;


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


    public function checkout($cartkey = 'customer')
    {
        // Check if the session contains the cart key
        if (!session()->has($cartkey)) {
            return redirect()->route('home')->withErrors('Your cart is empty. Please add items to your cart before checking out.');
        }
    
        // Fetch the cart from the session
        $cart = session()->get($cartkey, []);
    
        // Check if the cart is empty
        if (empty($cart)) {
            return redirect()->route('home')->withErrors('Your cart is empty. Please add items to your cart before checking out.');
        }
    
        // Calculate the subtotal
        $subtotal = array_reduce($cart, function($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);
    
        return view('main-site.checkout', compact('cart', 'subtotal'));
    }
    
    public function proccessCheckout(Request $request, $cartkey = 'customer')
    {
        // Check if the session contains the cart key
        if (!session()->has($cartkey)) {
            return redirect()->route('home')->withErrors('Your cart is empty. Please add items to your cart before checking out.');
        }


            
        // Validate the input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'county' => 'nullable|string|max:100',
            'postcode' => 'required|string|max:20',
            'additional_info' => 'nullable|string|max:500',
        ]);

        // Store the validated data in the session
        Session::put('customer_details', $validatedData);

        // Generate a unique 7-digit order number
        $order_no = $this->generateOrderNumber();
        session(['order_no' => $order_no]);


        // redirect to payment route
        return redirect()->route('payment');

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

    protected function generateOrderNumber()
    {
        do {
            $order_no = random_int(1000000, 9999999);   
        } while (Order::where('order_no', $order_no)->exists());

        return $order_no;
    }


    
}
