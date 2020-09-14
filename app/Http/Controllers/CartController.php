<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class CartController extends Controller
{
    /**
     * @documentation return Cart data
     */
    public function index() {
        $carts = Cart::get();

        return view('cart', ['carts' => $cart]);
    }

    /**
     * @documentation returning cart data by user id
     * 
     * @param user_id $user_id
     */
    public function getByUserId($user_id) {
        $carts = Cart::where('user_id', $user_id)->OrderBy('created_at', 'asc')->get();

        return view('cart', ['carts' => $carts]);
    }
    
    
    /**
     * @documentation detail product from active cart
     * 
     * @param product_id $id
     */
    public function getById($id) {
        $product = Product::where('product_id', $id)->limit(1)->get();

        return view('detail', ['product' => $product]);
    }

    /**
     * @documentation update cart data
     * 
     * @param Request $request
     * @param product_id $id
     */
    public function update(Request $request, $id) {
        $product = Product::where('product_id', $id)->first();

        $input = $request->all();
        $user->fill($input);
        $user->save();

        $response = [
            'message' => 'Updated Successfully!'
        ];

        return view()->with($response);
    }
}
