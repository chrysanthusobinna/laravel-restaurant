<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        // Share the logged-in user with all views
        view()->share('loggedInUser', Auth::User());
        
    }


    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(3);  
    
        return view('admin.orders-index', compact('orders'));
    }
    
    public function show($id)
    {
        $order = Order::with(['orderItems', 'createdByUser', 'updatedByUser', 'customer'])->findOrFail($id);
    
        $customer = $order->customer ? $order->customer : null; // Handle null customer
    
        return view('admin.orders-show', compact('order', 'customer'));
    }
    


    public function createOrder(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return back()->with('error', 'Cart is empty!');

        }

        $totalPrice = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        // Validate request data
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:customers,email',
            'phone_number' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:500',
            'payment_method' => 'required|max:255',  
        ]);

        // Check if at least one of the fields is provided then Create a new customer
        if ($request->filled(['name', 'email', 'phone_number', 'address'])) {
            // Create the customer
            $customer = Customer::create([
                'name' => $validatedData['name'] ?? null,
                'email' => $validatedData['email'] ?? null,
                'phone_number' => $validatedData['phone_number'] ?? null,
                'address' => $validatedData['address'] ?? null,
            ]);

            $customer_id = $customer->id;

        } else {
            $customer_id = null;
        }

        // Generate a unique 7-digit order number
        $order_no = $this->generateOrderNumber();

        // Create a new order
        $order = Order::create([
            'customer_id' => $customer_id,
            'order_no' => $order_no,
            'order_type' => 'instore',
            'created_by_user_id' => Auth::id(),
            'updated_by_user_id' => Auth::id(),
            'total_price' => $totalPrice,
            'status' => 'completed',
            'payment_method' => $validatedData['payment_method'],
        ]);

        if ($order) {
            // Create order items using the relationship
            foreach ($cart as $item) {
                $order->orderItems()->create([
                    'menu_name' => $item['name'],  
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);
            }
        }

        // Clear the cart
        session()->forget('cart');

        return redirect()->route('admin.index')->with('success', 'Order Created successfully.');
    }
    public function update(Request $request, $id)
    {
        // Validate the input data
        $request->validate([
            'status' => 'required|in:completed,cancelled',
        ]);
        $order = Order::findOrFail($id);

        $order->update(['status' => $request->status , 'updated_by_user_id' => Auth::id()]);
    
        return back()->with('success', 'Order status updated successfully');
    }

    
    // Function to generate a unique 7-digit order number
    protected function generateOrderNumber()
    {
        do {
            $order_no = random_int(1000000, 9999999);   
        } while (Order::where('order_no', $order_no)->exists());

        return $order_no;
    }
 
}
