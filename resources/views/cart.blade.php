@extends('layouts.pizzatower')

@section('content')
    @if(CartService::count() === 0)
        @if(!session('success'))
        No items in cart. Go to menu and buy something :)
        @endif
    @else
        <table class="table">
            <thead>
                <th scope="col">Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
                <th scope="col"></th>
            </thead>
            <tbody>
            @foreach(CartService::all() as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>
                        @if($item->qty > 1)
                            <a href="{{ route('cart.minus', $item->rawId()) }}" class="btn btn-light">-</a>
                        @endif
                        {{ $item->qty }}
                        <a href="{{ route('cart.plus', ['id' => $item->rawId()]) }}" class="btn btn-light">+</a>
                    </td>
                    <td>{{ $item->total.' '.$item->currency }}</td>
                    <td>
                        <a href="{{ route('cart.remove', $item->rawId()) }}" class="btn btn-danger">delete</a>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td>Delivery</td>
                <td></td>
                <td>{{ \App\Models\Order::DEFAULT_SHIPPING_PRICE.' '.session()->get('currency', 'usd') }}</td>
                <td></td>
            </tr>
            <tr>
                <td><b>Total</b></td>
                <td></td>
                <td></td>
                <td>{{ (\CartService::total() + \App\Models\Order::DEFAULT_SHIPPING_PRICE).' '.session()->get('currency', 'usd') }}</td>
            </tr>
            </tbody>
        </table>
        <h3>Order form</h3>
        <form method="POST" action="{{ route('orders.create') }}">
            @csrf
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" required class="form-control" name="address">
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" required class="form-control" name="name">
            </div>
            <div class="form-group">
                <label for="surname">Surname</label>
                <input type="text" required class="form-control" name="surname">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" required class="form-control" name="email">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @endif
@endsection
