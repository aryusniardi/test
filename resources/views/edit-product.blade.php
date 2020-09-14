@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="h3 text-xs font-weight-bold text-primary text-uppercase">Edit Product</h3>
    @foreach($product as $product)
    <form class="mt-3" action="{{route('product.update')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="product_id" value="{{$product->product_id}}" required>
        <input type="hidden" class="form-control" name="id" value="{{$product->product_id}}">
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="{{$product->product_name}}" required>
        </div>
        <div class="form-group">
            <label for="description">Product Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" placeholder="{{$product->product_desc}}" required></textarea>
        </div>
        <div class="form-group">
            <label for="price">Product Price</label>
            <input type="number" class="form-control" id="price" name="price" placeholder="{{$product->product_price}}" pattern= “^[0–9]$” required>
        </div>
        <div class="form-group d-block">
            <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-primary mt-4 d-block w-25 mx-auto">Submit</button>
    </form>
    @endforeach
</div>
@endsection