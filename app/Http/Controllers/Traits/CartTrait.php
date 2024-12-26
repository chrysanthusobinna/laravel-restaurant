<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;

trait CartTrait
{
    public function addToCart(Request $request)
    {
        // Validate the request
        $request->validate([
            'cartkey' => 'required|string',
            'id' => 'required|integer',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'img_src' => 'nullable|string',
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
                'img_src' => $request->img_src ?? '',
                'quantity' => 1,
            ];            
        }
    
        // Update the session with the new cart
        session()->put($request->cartkey, $cart);

        $totalItems = $this->getTotalItems($request->cartkey);

            return response()->json([
                'success' => true,
                'cart' => $cart,
                'total_items' => $totalItems,
            ]);
     
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
    
        $totalItems = $this->getTotalItems($request->cartkey);
    
        return response()->json([
            'success' => true,
            'cart' => $cart,
            'total_items' => $totalItems,
        ]);
    }
    



    public function getCart(Request $request)
    {
        $cart = session()->get($request->cartkey, []);

        return response()->json([
            'cart' => $cart,
        ]);
    }

    public function clearCart(Request $request)
    {
        session()->forget($request->cartkey);

        return response()->json([
            'success' => true,
            'cart' => [],
        ]);

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
    
        $totalItems = $this->getTotalItems($request->cartkey);
    
        return response()->json(['success' => true, 'cart' => $cart, 'total_items' => $totalItems]);
    }
    
    

    public function getTotalItems($cartkey)
    {
        // Retrieve the cart from the session
        $cart = session()->get($cartkey, []);
    
        // Calculate the total number of items in the cart
        $totalItems = 0;
        foreach ($cart as $item) {
            // Ensure the item has a 'quantity' key
            if (isset($item['quantity'])) {
                $totalItems += $item['quantity'];
            }
        }
        return $totalItems;
 
    }
    
       
}
