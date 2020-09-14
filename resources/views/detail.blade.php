@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach($product as $product)
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card h-50">
                    <img class=" img-fluid" src="{{asset('storage/'.$product->product_image)}}" alt="">
                </div>
            </div>
            <div class="col-lg-8 col-md-6 col-sm-12 my-auto">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">
                            {{$product->product_name}}
                        </h2>
                        <h5 class="card-price">Rp.{{number_format($product->product_price, 2)}}</h5>
                        <p class="card-text h5">{{$product->product_desc}}</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('product.addToCart', ['id' => $product->product_id])}}" role="button" class="btn btn-primary btn-lg">Add to Cart</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
