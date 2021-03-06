<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Order;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = Order::OrderBy('order_id', 'ASC')->get();
        $products = Product::OrderBy('product_id', 'ASC')->get();

        return view('home', ['products' => $products, 'orders' => $orders]);
    }
}
