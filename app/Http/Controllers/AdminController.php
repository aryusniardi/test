<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * @documentation return view register form (cms.register)
     */
    public function register() {
        if(Auth::user()) {
            return redirect()->route('home');
        } else {
            return view('admin.register');
        }
    }

    /**
     * @documentation register user as admin
     * @param Request $request
     */
     public function index() {
        $products = Product::get();
        $orders = Order::get();

        return view('home', ['products' => $products, 'orders' => $orders]);
    }

    /**
     * @documentation update order status
     * @param Request $request
     */
     public function updateStatus(Request $request) {
        $order = Order::where('order_id', $request->input('order_id'))->first();
        $order->status = $request->input('status');
        $order->save();

        return redirect()->back();
    }
}