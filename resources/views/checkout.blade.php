@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your cart</span>
            </h4>
            <ul class="list-group mb-3">
                @foreach($products as $product)
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">{{$product['item']['product_name']}}{{'  '}}<b>({{$product['quantity']}})</b></h6>
                    </div>
                    <span class="text-muted">Rp.{{number_format($product['price'], 2)}}</span>
                </li>
                @endforeach
                <li class="list-group-item d-flex justify-content-between">
                    <span><strong>Total (Rp)</strong></span>
                    <strong>Rp.{{number_format($total, 2)}}</strong>
                </li>
            </ul>
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Order Address</h4>
            <form class="needs-validation" action="{{route('store-order')}}" method="post">
                <input type="hidden"  name="user_id" value="{{Auth::user()->id}}">
                <div class="mb-3">
                    <label for="fullName">Full Name</label>
                    <input type="text" class="form-control" id="fullName" value="{{Auth::user()->name}}" disabled>
                    <div class="invalid-feedback">
                        Valid full name is required.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" value="{{Auth::user()->email}}" disabled>
                    <div class="invalid-feedback">
                        Please enter a valid email address for shipping updates.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="" required="">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>Please enter your shippling address.</strong>
                        </span>
                    @enderror
                </div>
                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Place order</button>
            </form>
        </div>
    </div>
</div>
@endsection
