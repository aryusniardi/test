@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="h3 text-xs font-weight-bold text-primary text-uppercase">Create Product</h3>
    <form class="mt-3" action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="description">Product Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="price">Product Price</label>
            <input type="number" class="form-control" id="price" name="price" pattern= “^[0–9]$” required>
        </div>
        <div class="form-group d-block">
            <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-primary mt-4 d-block w-25 mx-auto">Submit</button>
    </form>
</div>
@endsection
