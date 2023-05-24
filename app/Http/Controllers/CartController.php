<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function cartList()
    {
        $cartItems = \Cart::getContent();
        return view('cart', compact('cartItems'));
    }
    public function checkoutList()
    {
        $cartItems = \Cart::getContent();
        return view('checkout', compact('cartItems'));
    }
    public function addToCart(Request $request)
    {
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->image,
            )
        ]);
        session()->flash('success', 'Product is Added to Cart Successfully !');
        return redirect()->route('cart.list');
    }
    public function updateCart(Request $request)
    {
        \Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );
        session()->flash('success', 'Item Cart is Updated Successfully !');
        return redirect()->route('cart.list');
    }
    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);
        session()->flash('success', 'Item Cart Remove Successfully !');
        return redirect()->route('cart.list');
    }
    public function clearAllCart()
    {
        \Cart::clear();
        session()->flash('success', 'All Item Cart Clear Successfully !');
        return redirect()->route('cart.list');
    }

    public function checkout(Request $request)
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Get the cart items
        $cartItems = \Cart::getContent($request->id);

        // Calculate the total price of the cart items
        $totalPrice = \Cart::getTotal($request->id);

        // Perform the checkout process
        try {
            // Start a database transaction
            DB::beginTransaction();

            // Create a new order
            $order = new Order();
            $order->user_id = $user->id; // Set the user ID
            $order->total_price = $totalPrice; // Set the total price
            $order->save();

            // Attach the cart items to the order
            foreach ($cartItems as $item) {
                $order->products()->attach($item->id, ['quantity' => $item->quantity]);
            }

            // Commit the transaction
            DB::commit();

            // Clear the cart
            \Cart::clear();
            
            
            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            // Handle the exception
            DB::rollback();
            
            // Redirect to an error page or display an error message   
            return redirect()->route('cart.list')->with('error', 'An error occurred during checkout. Please try again.');     
        }
    }
}