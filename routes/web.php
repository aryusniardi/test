<?php

use Illuminate\Support\Facades\Route;
use App\Mail\OrderMail;

Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/email', function () {
    return new OrderMail();
});

Route::group(['middleware' => 'verified'], function() {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/detail/{id}', "ProductController@getById")->name('detail');

    Route::get('/add-to-cart/{id}', 'ProductController@addToCart')->name('product.addToCart');
    Route::get('/shopping-cart', 'ProductController@getCart')->name('product.shoppingCart');

    Route::get('/checkout', 'ProductController@getCheckout')->name('checkout');
    Route::post('/order', 'OrderController@store')->name('store-order');
    Route::post('/store-image', 'OrderController@uploadImage')->name('store-image');
    Route::get('/my-order/{user_id}', 'OrderController@getByUserId')->name('my-order');
    Route::get('/get-order/{user_id}')->name('detail-order');

    Route::post('/update-status', 'AdminController@updateStatus')->name('update-status');
});

Route::group(['prefix' => 'cms'], function() {
    Route::get('/cms-orders', 'AdminController@index')->name('orders');
    Route::post('/login-process', 'AdminController@login_process')->name('login.process');
    Route::get('/register', 'AdminController@register')->name('cms.register');
    Route::post('/register-process', 'AdminController@register_process')->name('register.process');
    Route::get('/', 'AdminController@index')->name('cms.home');

    Route::get('/form-product', 'ProductController@form')->name('product.form');
    Route::post('/store-product', 'ProductController@store')->name('product.store');
    Route::get('/edit-product/{id}', 'ProductController@edit')->name('product.edit');
    Route::post('/update-product', 'ProductController@update')->name('product.update');
    Route::get('/delete-product/{id}', 'ProductController@delete')->name('product.delete');
    
});