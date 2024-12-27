<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Testimony;
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
use App\Http\Requests\CustomerDetailsRequest;
use App\Http\Controllers\Traits\OrderNumberGeneratorTrait;
use App\Http\Controllers\Traits\MainSiteViewSharedDataTrait;


class MainSiteController extends Controller
{
    use CartTrait;
    use MainSiteViewSharedDataTrait;
    use OrderNumberGeneratorTrait;


    public function __construct()
    {
        $this->shareMainSiteViewData();
    }

    public function home()
    {


        $menus = Menu::inRandomOrder()->get();
        $blogs = Blog::orderBy('created_at', 'desc')->limit(3)->get();
        $testimonies = Testimony::inRandomOrder()->limit(5)->get();




        return view('main-site.index', compact('menus','blogs','testimonies'));
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
    

    public function menu(Request $request)
    {
        $validated = $request->validate([
            'search' => 'nullable|string|max:255',
        ]);

        $query = Category::with(['menus' => function ($query) use ($request) {
            if ($request->has('search') && $request->search != '') {
                $query->where('name', 'like', '%' . $request->search . '%');
            }
        }]);
    
        $categories = $query->get();
    
        return view('main-site.menu', compact('categories'));
    }
    

    public function menuItem($id)
    {
        $menu = Menu::with(['category'])->findOrFail($id);
        $cart = session()->get($this->cartkey, []);

        function getItemQuantity($cart, $itemId) {
            foreach ($cart as $item) {
                if ($item['id'] == $itemId) {
                    return $item['quantity'];
                }
            }
            return 0; // Return 0 if item is not found
        }
        
        // Usage example
        $quantity = getItemQuantity($cart, $id);
        
    
    
        // Fetch 5 random related menus  
        $relatedMenus = Menu::where('id', '!=', $id)->inRandomOrder()->limit(5)->get();
    
        return view('main-site.menu-item', compact('menu','quantity', 'relatedMenus'));
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
    
    

    public function blogs(Request $request)
    {
        $validated = $request->validate([
            'search' => 'nullable|string|max:255',
        ]);
    
        $query = Blog::query();
    
        // Check if there's a search query
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')->orWhere('content', 'like', '%' . $request->search . '%');
        }
    
        $blogs = $query->paginate(10);
    
        return view('main-site.blogs', compact('blogs'));
    }
    
    public function blogView($id)
    {
        $blog = Blog::findOrFail($id);

        $relatedBlogs = Blog::where('id', '!=', $id)->inRandomOrder()->limit(5)->get();

        return view('main-site.blog-view', compact('blog','relatedBlogs'));
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
