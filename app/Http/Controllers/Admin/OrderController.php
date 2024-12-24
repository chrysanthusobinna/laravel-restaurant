<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Traits\OrderStatisticsTrait;
use App\Http\Controllers\Traits\OrderNumberGeneratorTrait;

class OrderController extends Controller
{
    use OrderStatisticsTrait;
    use OrderNumberGeneratorTrait;

    public function __construct()
    {
        // Share the logged-in user with all views
        view()->share('loggedInUser', Auth::User());
        
        $this->shareOrderStatistics();
        
    }


    public function index(Request $request)
    {
        //$orders = Order::orderBy('id', 'desc')->paginate(3);  

       // $orders = Order::orderBy('id', 'desc')->get();;  

        //return view('admin.orders-index', compact('orders'));

        if ($request->ajax()) {

            //$order = Order::query();
            $orders = Order::select(['id', 'order_no', 'created_at', 'total_price', 'status', 'order_type'])->orderBy('id', 'desc');

            return Datatables::of($orders)
                    ->addIndexColumn()
                    ->addColumn('action', function ($order) {
                        return '<a href="'.route('admin.orders.show', $order->id).'" class="btn btn-secondary btn-sm"><i class="fa fa-eye"></i></a>';
                    })
                    ->editColumn('order_no', function ($order) {
                        return "#".$order->order_no;
                    })                   
                    ->editColumn('created_at', function ($order) {
                        return $order->created_at->format('g:i A -  j M, Y');
                    })          
 
                    ->editColumn('total_price', function ($order) {
                        return '$' . number_format($order->total_price, 2);
                    })
                    ->editColumn('status', function ($order) {
                        return $order->status == 'pending' 
                            ? '<span class="badge badge-danger"><i class="fa fa-exclamation-circle"></i>'.ucfirst($order->status).'</span>' 
                            : ucfirst($order->status);
                    })
                    
                    ->editColumn('order_type', function ($order) {
                        return ucfirst($order->order_type);
                    })                   
                    ->rawColumns(['action','status'])
                    ->make(true);
        }
          
        return view('admin.orders-index');
    }
    
    public function show($id)
    {
        $order = Order::with(['orderItems', 'createdByUser', 'updatedByUser', 'customer'])->findOrFail($id);
    
        $customer = $order->customer ? $order->customer : null; // Handle null customer
    
        return view('admin.orders-show', compact('order', 'customer'));
    }
    


    public function createOrder(Request $request)
    {
        $cart = session()->get($request->cartkey, []);
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
        session()->forget($request->cartkey);

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

 
 
}
