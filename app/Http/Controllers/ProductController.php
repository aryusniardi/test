<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use App\Order;
use Session;

class ProductController extends Controller
{
    /**
     * @documentation return product data
     */
    public function index() {
        $product = Product::get();
    }
    
    /**
     * @documentation return product data 
     * 
     * @param product_id $id
     */
    public function getById($id) {
        $product = Product::where('product_id', $id)->limit(1)->get();

        return view('detail', ['product' => $product]);
    }

    /**
     * @documentation create new product
     * 
     * @param Request $request
     */
    public function store(Request $request) {        
        $input = $request->all();

        $product = new Product();
        $product->product_name = $request->input('name');
        $product->product_desc = $request->input('description');
        $product->product_price = $request->input('price');

        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $photo_fullpath = $file->getClientOriginalName();
            $photo_path = public_path() . '\storage';
            $photo = str_replace($photo_path, '', $photo_fullpath);

            $request->file('image')->move(public_path() . '\storage', $photo);
            $product->product_image = $photo;
        }

        $product->save();   
        $products = Product::OrderBy('product_id', 'DESC')->get();
        $orders = Order::get();
        return view('home', ['products' => $products, 'orders' => $orders]);
    }

    /**
     * @documentation access edit form for product
     * 
     * @param product_id $id
     */
    public function edit($id) {
        $product = Product::where('product_id', $id)->limit(1)->get();

        return view('edit-product', ['product' => $product]);
    }
    
    /**
     * @documentation update product 
     * 
     * @param Request $request
     */
    public function update(Request $request) {
        $product = Product::where('product_id', $request->input('product_id'))->first();

        $product->product_name = $request->input('name');
        $product->product_desc = $request->input('description');
        $product->product_price = $request->input('price');
        
        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $photo_fullpath = $file->getClientOriginalName();
            $photo_path = public_path() . '\storage';
            $photo = str_replace($photo_path, '', $photo_fullpath);

            $request->file('image')->move(public_path() . '\storage', $photo);
            $product->product_image = $photo;
        }
        
        $product->save();

        $products = Product::OrderBy('product_id', 'DESC')->get();
        $orders = Order::get();
        return view('home', ['products' => $products, 'orders' => $orders]);
    }

    /**
     * @documentation delete product
     * 
     * @param product_id $id
     */
    public function delete($id) {
        $product = Product::where('product_id', $id)->first();
        
        $product->delete();
        $response = [
            'message' => 'Deleted Successfully!',
        ];

        return redirect()->back();
    }

    /**
     * @documentation store selected product to cart
     * 
     * @param Request $request
     * @param product_id $id
     */
    public function addToCart(Request $request, $id) {
        $product = Product::where('product_id', $id)->first();

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        
        $cart->add($product, $product->product_id);

        $request->session()->put('cart', $cart);
        return redirect()->back();
    }

    /**
     * @documentation access cart 
     */
    public function getCart() {
        if(!Session::has('cart')) {
            return view('shopping-cart');
        } 

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        return view('shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice, 'totalQuantity' => $cart->totalQuantity]);
    }

    /**
     * @documentation access checkout
     */
    public function getCheckout() {
        if(!Session::has('cart')) {
            return view('shopping-cart');
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        $total = $cart->totalPrice;
        return view('checkout', ['products' => $cart->items, 'total' => $total]);
    }

    /**
     * @documentation return form view for create new product
     */
    public function form() {
        return view('create-product');
    }
}
