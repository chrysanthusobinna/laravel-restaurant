<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\OrderSettings;
use App\Models\LiveChatScript;
use App\Helpers\DistanceHelper;
use App\Models\RestaurantAddress;
use App\Models\SocialMediaHandle;
use App\Models\RestaurantPhoneNumber;
use App\Models\RestaurantWorkingHour;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Traits\CartTrait;
use GetCountryCurrency\CountryCurrencyAPI;
use App\Http\Requests\CustomerDetailsRequest;
use App\Http\Controllers\Traits\ViewSharedDataTrait;
use App\Http\Controllers\Traits\OrderNumberGeneratorTrait;


class MainSiteController extends Controller
{
    use CartTrait;
    use ViewSharedDataTrait;
    use OrderNumberGeneratorTrait;


    public function __construct()
    {
        $this->initializeSharedLogic();
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
        $categories = Category::with('menus')->get();  
        return view('main-site.menu',compact('categories'));
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
        // Check if the session contains the cart key
        if (!session()->has($this->cartkey)) {
            return redirect()->route('menu')->withErrors('Your cart is empty. Please add items to your cart before checking out.');
        }
    
        // Fetch the cart from the session
        $cart = session()->get($this->cartkey, []);
    
        // Check if the cart is empty
        if (empty($cart)) {
            return redirect()->route('menu')->withErrors('Your cart is empty. Please add items to your cart before checking out.');
        }
    
        // Calculate the subtotal
        $subtotal = array_reduce($cart, function($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);
    
        return view('main-site.checkout', compact('cart', 'subtotal'));
    }
    
    public function proccessCheckout(CustomerDetailsRequest $request)
    {
        // Check if the session contains the cart key
        if (!session()->has($this->cartkey)) {
            return redirect()->route('menu')->withErrors('Your cart is empty. Please add items to your cart before checking out.');
        }


        $order_settings = OrderSettings::firstOrNew();

        if (!$order_settings->exists) {
            // OrderSettings has no data
            return redirect()->route('home')->withErrors('No order settings found.');
        }
        $price_per_mile =   $order_settings->price_per_mile;
        $distance_limit_in_miles = $order_settings->distance_limit_in_miles;

        $restaurant_address = $this->firstRestaurantAddress ?? config('site.address');
        $delivery_address   = $request->address . ' ' . $request->city . ' ' . $request->state . ' ' . $request->postcode;

        // Call the DistanceHelper to get the distance
        $distanceData = DistanceHelper::getDistance($restaurant_address, $delivery_address);

        // Check if there's an error
        if (isset($distanceData['error'])) {
            return back()->withErrors($distanceData['error']);
        }

        $distance_in_miles= $distanceData['value_in_miles'];

        if ($distance_in_miles > $distance_limit_in_miles) {
            $error_message = "We're sorry! We can only deliver within {$distance_limit_in_miles} miles. You can still place your order as a walk-in at our restaurant located at {$restaurant_address}. We look forward to serving you!";
            return back()->withErrors($error_message)->withInput();
        }
        
        $delivery_fee = ceil($price_per_mile * $distance_in_miles * 100) / 100;

        // Store delivery_fee , price_per_mile and distance_in_miles in  session 
        session()->put('delivery_details', [ 'delivery_fee' => $delivery_fee, 'distance_in_miles' => $distance_in_miles,  'price_per_mile' => $price_per_mile, ]);

        // Store the validated data in the session
        Session::put('customer_details', $request->validated());

        // Generate a unique 7-digit order number and store in session
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
 

    
}
