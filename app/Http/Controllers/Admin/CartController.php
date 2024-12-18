<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    
    public function __construct()
    {
        // Share the logged-in user with all views
        view()->share('loggedInUser', Auth::User());
        
    }
    
 
    public function index()
    {
        $menus = Menu::all();
        return view('admin.pos-index',compact('menus'));
    } 



    public function addToCart(Request $request)
    {
        // Validate the request
        $request->validate([
            'cartkey' => 'required|string',
            'id' => 'required|integer',
            'name' => 'required|string',
            'price' => 'required|numeric',
        ]);
        
        $cart = session()->get($request->cartkey, []);
    
        if (isset($cart[$request->id])) {
            // Increase the quantity if the item is already in the cart
            $cart[$request->id]['quantity']++;
        } else {
            // Otherwise, add the item to the cart
            $cart[$request->id] = [
                'id' => $request->id,
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => 1,
            ];
        }
    
        // Update the session with the new cart
        session()->put($request->cartkey, $cart);
    
        if ($request->cartkey == "admin") {
            return response()->json([
                'success' => true,
                'cart' => $cart,
            ]);
        } elseif ($request->cartkey == "customer") {
            return back()->with('success', 'Item added to cart!');
        }
    }
    

    public function removeFromCart(Request $request)
    {
        $cart = session()->get($request->cartkey, []);

        if (isset($cart[$request->id])) {
            // Remove the item from the cart
            unset($cart[$request->id]);
        }

        // Update the session
        session()->put($request->cartkey, $cart);

        if ($request->cartkey == "admin") {
            return response()->json([
                'success' => true,
                'cart' => $cart,
            ]);
        } elseif ($request->cartkey == "customer") {
            return back()->with('success', 'Item removed from cart!');
        }


    }

    public function getCart(Request $request)
    {

        $cart = session()->get($request->cartkey, []);

        if ($request->cartkey == "admin") {
            return response()->json([
                'cart' => $cart,
            ]);
        } elseif ($request->cartkey == "customer") {
            return back();
        }

    }

    public function clearCart(Request $request)
    {
        session()->forget($request->cartkey);

        if ($request->cartkey == "admin") {
            return response()->json([
                'success' => true,
                'cart' => [],
            ]);
        } elseif ($request->cartkey == "customer") {
            return back()->with('success', 'All Item removed from cart!');
        }

    }
 

    public function updateCartQuantity(Request $request)
    {
        $cart = session()->get($request->cartkey, []);
        $id = $request->input('id');
        $quantity = $request->input('quantity');
    
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $quantity;
            session()->put($request->cartkey, $cart);
        }

        
        if ($request->cartkey == "admin") {
            return response()->json(['success' => true, 'cart' => $cart]);

        } elseif ($request->cartkey == "customer") {
            return back()->with('success', 'Item updated from cart!');
        }

    }

    
}
