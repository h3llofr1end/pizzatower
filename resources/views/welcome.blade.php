<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Pizza Tower</title>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

        <style>
            .col-sm-4 {
                margin-bottom: 15px;
            }
            .card-body {
                min-height: 130px !important;
            }
            .container {
                margin-top: 25px;
            }
        </style>
    </head>
    <body class="antialiased">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="nav-link">My orders</a>
                    @else
                        <a href="{{ route('login') }}" class="nav-link">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="nav-link">Register</a>
                        @endif
                    @endif
                        <a href="{{ url('/cart') }}" class="nav-link">Сart</a>
                </div>
            </div>
        </nav>
        <div class="container">
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
                                <b style="display:inline; width: 33%">{{ $pizza->price_usd }}$</b>
                                <input name="quantity" type="number" class="form-control" min="1" style="display:inline; height: 35px; width: 33%" value="1" />
                                <a href="#" style="display:inline; width: 33%" class="btn btn-primary">Add to cart</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </body>
</html>
