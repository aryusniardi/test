<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Cart;
use App\Order;
use App\Mail\OrderMail;
use Session;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * @documentation get order data by user_id
     * 
     * @param user_id $user_id
     */
    public function getByUserId($user_id) {
        $order = Order::where('user_id', $user_id)->get();
        $user = User::where('id', $user_id)->first();

        return view('order', ['orders' => $order, 'user' => $user]);
    }

    /**
     * @documentation upload transaction image, update data order
     * 
     * @param Request $request
     */
    public function uploadImage(Request $request) {
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();

        if ($request->hasFile('image')) {
            $order = Order::where('order_id', $request->input('order_id'))->first();
            $photo_fullpath = $file->getClientOriginalName();
            $photo_path = public_path() . '\storage';
            $photo = str_replace($photo_path, '', $photo_fullpath);

            $request->file('image')->move(public_path() . '\storage', $photo);
            $order->payment_photo = $photo;
            $order->save();   
        }

        return redirect()->back();
    }
    
    /**
     * @documentation store order data from current user cart session
     * 
     * @param Request $request
     */
    public function store(Request $request) {
        if(!Session::has('cart')) {
            return view('shopping-cart');
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $items = $cart->items;
        $totalPrice = $cart->totalPrice;
        
        $input = $request->all();
        $user_id = $input['user_id'];
        $address = $input['address'];
        $user = User::find($user_id);
        $full_name = $user->name;
        $email = $user->email;

        $order = new Order();
        $order->user_id = $user_id;
        $order->address = $address;
        $order->total = $totalPrice;

        $order->save();

        Mail::to($email)->send(new OrderMail());
        Session()->flush('cart');
        return redirect()->route('home');
    }
}
