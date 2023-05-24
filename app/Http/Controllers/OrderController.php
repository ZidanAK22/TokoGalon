<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    public function index()
    {
        // Get the currently authenticated user
        $user = auth()->user();

        // Retrieve the user's orders with the associated products and quantities
        $orders = Order::with('products')->where('user_id', $user->id)->get();

        return view('pastorders', compact('orders'));
    }
}
