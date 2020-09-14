@extends('layouts.app')

@section('content')
    <div class="container">
        @if(Session::has('cart'))
        <div class=" row order-md-2 d-block mb-4 mx-auto">
            <h4 class="d-flex justify-content-between align-items-center mb-4">
                <span class="h2"><strong>Your cart</strong></span>
                <span class="badge badge-danger badge-pill">{{$totalQuantity}}</span>
            </h4>
            <ul class="list-group mb-3">
                @foreach($products as $product)
                <li class="list-group-item d-flex lh-condensed">
                    <div class="col-11">
                        <h4 class="my-0"><b>{{$product['item']['product_name']}}</b></h4>
                        <p class="card-title text-primary">Rp.{{number_format($product['item']['product_price'], 2)}}</p>
                        <p class="text-muted card-title">{{$product['item']['product_desc']}}</p>
                    </div>
                    <div class="col-1 btn-group text-center" role="group" aria-label="Basic example">
                        <h5 class="text-muted my-auto">{{$product['quantity']}}</h5>
                    </div>
                </li>
                @endforeach
            </ul>
            <hr class="mb-5">
            <br>
            <h2 class="mr-4">Total Price</h2>
            <h2 class="ml-2"><b>Rp.{{number_format($totalPrice, 2)}}</b></h2>
            <hr class="mb-4">
            <a href="{{route('checkout')}}" class="btn btn-primary btn-lg d-block">Continue to checkout</a>
        </div>
        @else
        <div class=" row order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="h2"><strong>Cart is Empty!</strong></span>
            </h4>
        </div>
        @endif
    </div>
</div>
@endsection
