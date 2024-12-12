<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\User;
use App\Models\Order;
use App\Models\Customer;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class POSController extends Controller
{

    public function __construct()
    {
        // Share the logged-in user with all views
        view()->share('loggedInUser', Auth::User());
        
    }
    
    // Display POS dashboard
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

    

    public function submitOrder(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return response()->json(['success' => false, 'message' => 'Cart is empty']);
        }

        $totalPrice = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        
        // Check if at least one of the fields is provided then Create a new customer
        if ($request->filled(['name', 'email', 'phone_number', 'address'])) {
            // Validate only the fields that are provided
            $validatedData = $request->validate([
                'name' => 'nullable|string|max:255',
                'email' => 'nullable|email|max:255|unique:customers,email',
                'phone_number' => 'nullable|string|max:15',
                'address' => 'nullable|string|max:500',
            ]);

            // Create the customer
            $customer = Customer::create([
                'name' => $validatedData['name'] ?? null,
                'email' => $validatedData['email'] ?? null,
                'phone_number' => $validatedData['phone_number'] ?? null,
                'address' => $validatedData['address'] ?? null,
            ]);

            $customer_id = $customer->id;

        }
        else
        {
            $customer_id = null;
        }


        // Create a new order
        $order = Order::create([
            'customer_id' => $customer_id,
            'order_type' => 'instore',
            'created_by_user_id' => Auth::id(),
            'updated_by_user_id' => Auth::id(),
            'total_price' => $totalPrice,
            'status' => 'completed'
        ]);
 
        if ($order) {
            // Create order items using the relationship
            foreach ($cart as $item) {
                $order->orderItems()->create([
                    'menu_id' => $item['id'],   
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);
            }
        }
        // Clear the cart
        //session()->forget('cart');

        return redirect()->route('admin.index')->with('success', 'Order Created successfully.');

    }
 
}
