@extends('layouts.app')

@section('content')
<div class="container">
    @foreach($orders as $order)
    <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
            <span class="badge badge-success w-25">{{$order->status}}</span>
            <h3 class="mb-0">{{$user->email}}</h3>
            <div class="mb-1 text-muted">{{$order->address}}</div>
            <p class="mb-auto text-primary"><strong>Rp.{{number_format($order->total, 2)}}</strong></p>
        </div>
        <div class="col-auto d-block p-4">
            @if (is_null($order->payment_photo))
                <form class="mt-3" action="{{route('store-image')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group d-block">
                        <input type="hidden" name="order_id" value="{{$order->order_id}}">
                        <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg" class="form-control-file">
                        <button type="submit" class="btn btn-primary mt-4">Upload</button>
                    </div>
                </form>
            @else
                <img class="img-fluid payment-image" src="{{asset('storage/'.$order->payment_photo)}}" alt="">
            @endif
        </div>
    </div>
    @endforeach
</div>
@endsection
