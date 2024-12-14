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
        // Get the cart from the session, or initialize an empty array if it doesn't exist
        $cart = session()->get('cart', []);

        // Check if the item is already in the cart
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

        // Update the session
        session()->put('cart', $cart);

        // Return the updated cart as a response
        return response()->json([
            'success' => true,
            'cart' => $cart,
        ]);
    }

    public function removeFromCart(Request $request)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$request->id])) {
            // Remove the item from the cart
            unset($cart[$request->id]);
        }

        // Update the session
        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'cart' => $cart,
        ]);
    }

    public function getCart()
    {
        $cart = session()->get('cart', []);
        return response()->json([
            'cart' => $cart,
        ]);
    }

    public function clearCart()
    {
        session()->forget('cart');
        return response()->json([
            'success' => true,
            'cart' => [],
        ]);
    }
 

    public function updateCartQuantity(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->input('id');
        $quantity = $request->input('quantity');
    
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $quantity;
            session()->put('cart', $cart);
        }
    
        return response()->json(['success' => true, 'cart' => $cart]);
    }

    
}
