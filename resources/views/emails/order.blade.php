@component('mail::message')
# Thank you for Ordering,
{{Auth::user()->name}}

@component('mail::button', ['url' => ''])
<div class="container">
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your order</span>
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
                <br>
                <br>
                <span><strong>Total </strong></span>
                <strong>Rp.{{number_format($total, 2)}}</strong>
            </ul>
        </div>
    </div>
</div>
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
