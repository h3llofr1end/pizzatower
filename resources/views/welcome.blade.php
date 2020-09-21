@extends('layouts.pizzatower')

@section('content')
    <div class="row">
        @foreach($pizzas as $pizza)
            <div class="col-sm-4">
                <div class="card">
                    <img src="{{ $pizza->image }}" class="card-img-top" alt="{{ $pizza->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $pizza->name }}</h5>
                        <p class="card-text">{{ $pizza->description }}</p>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('cart.add', $pizza->id) }}">
                        @csrf
                        <b style="display:inline; width: 33%">
                            {{ $pizza->price }}
                            @if(session()->get('currency') === 'eur')
                                €
                            @else
                                $
                            @endif
                        </b>
                        <input name="quantity" type="number" class="form-control" min="1" style="display:inline; height: 35px; width: 33%" value="1" />
                        <button type="submit" style="display:inline; width: 33%" class="btn btn-primary">Add to cart</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
