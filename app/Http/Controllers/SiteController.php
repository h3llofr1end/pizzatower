<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use http\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SiteController extends Controller
{
    public function index()
    {
        return response()->view('welcome', [
            'pizzas' => Pizza::all()
        ]);
    }

    public function changeLocale($locale)
    {
        if(!in_array($locale, ['en', 'eu'])) {
            abort(400);
        }
        App::setLocale($locale);
        return response()->redirectTo(url()->previous());
    }

    public function cart()
    {
        return response()->view('cart');
    }
}
