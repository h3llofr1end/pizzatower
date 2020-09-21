@extends('layouts.pizzatower')

@section('content')
    <h2>My orders</h2>
    @if($orders->count() > 0)
        <table class="table">
            <thead>
            <th scope="col">Date</th>
            <th scope="col">Total</th>
            <th scope="col">Items</th>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <td>{{ $order->updated_at }}</td>
                    <td>{{ $order->total.' '.$order->currency }}</td>
                    <td>
                        <ul>
                            @foreach($order->items as $item)
                                <li>{{ $item->product->name }} x{{ $item->quantity }} = {{ $item->total.' '.$order->currency }}</li>
                            @endforeach
                            <li>Delivery = {{ \App\Models\Order::DEFAULT_SHIPPING_PRICE.' '.$order->currency }}</li>
                        </ul>
                    </td>
                @endforeach
            </tbody>
        </table>
    @else
        You don't have orders. Let's go make someone ;)
    @endif
@endsection
