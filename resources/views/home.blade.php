@extends('layouts.app')

@section('content')
@if(Auth::user()->roles != 'admin')
<div class="container">
    <h1 class="title-outline">Shop</h1>
    <div class="row justify-content-center">
        @foreach($products as $product)
            <div class="col-lg-3 col-md-4 mb-4">
                <div class="card h-100">
                    <a href="{{url('detail/'.$product->product_id)}}"><img class="card-img-top" src="{{asset('storage/'.$product->product_image)}}" alt=""></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="{{url('detail/'.$product->product_id)}}">{{$product->product_name}}</a>
                        </h4>
                        <h5 class="card-price">Rp.{{number_format($product->product_price, 2)}}</h5>
                        <p class="card-text">{{$product->product_desc}}</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('product.addToCart', ['id' => $product->product_id])}}" role="button" class="btn btn-primary btn-sm">Add to Cart</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@else 
<div class="container">
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-12 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center d-block">
                        <div class="d-flex">
                            <a class="h3 text-xs font-weight-bold text-primary text-uppercase link-stretch">Products</a>
                            <a href="{{route('product.form')}}" class="btn btn-primary w-25 ml-auto">Create Product</a>
                        </div>
                        <div class="scrolling-wrapper mt-5">
                            @foreach($products as $product)
                                <div class="col-3 mb-4">
                                    <div class="card h-100">
                                        <a href="{{url('detail/'.$product->product_id)}}"><img class="card-img-top" src="{{asset('storage/'.$product->product_image)}}" alt=""></a>
                                        <div class="card-body">
                                            <h4 class="card-title">
                                                <a href="{{url('detail/'.$product->product_id)}}">{{$product->product_name}}</a>
                                            </h4>
                                            <h5 class="card-price">Rp.{{number_format($product->product_price, 2)}}</h5>
                                            <p class="card-text">{{$product->product_desc}}</p>
                                        </div>
                                        <div class="card-footer">
                                            <a href="{{route('product.edit', ['id' => $product->product_id])}}" role="button" class="btn btn-secondary btn-sm">Edit</a>
                                            <a href="{{route('product.delete', ['id' => $product->product_id])}}" role="button" class="btn btn-danger btn-sm">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-12 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center d-block">
                    <a href="#" class="h3 text-xs font-weight-bold text-success text-uppercase">Orders</a>
                    @foreach($orders as $order)
                    <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-static">
                            <h3 class="mb-0">{{$order->email}}</h3>
                            <div class="mb-1 text-muted">{{$order->address}}</div>
                            <p class="mb-auto text-primary"><strong>Rp.{{number_format($order->total, 2)}}</strong></p>
                            @if($order->status == 'pending' || $order->status == 'Pending')
                            <form action="{{route('update-status')}}" method="post">
                                @csrf
                                <input type="hidden" name="order_id" value="{{ $order->order_id }}">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Status</label>
                                    <select class="form-control" name="status" id="exampleFormControlSelect1">
                                        <option>Pending</option>
                                        <option>Delivered</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary mt-4">Update</button>
                            </form>
                            @else 
                                <span class="badge badge-success w-25">{{$order->status}}</span>
                            @endif
                        </div>
                        <div class="col-auto d-block p-4">
                            @if (is_null($order->payment_photo))
                            @else
                                <img class="img-fluid payment-image" src="{{asset('storage/'.$order->payment_photo)}}" alt="">
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
