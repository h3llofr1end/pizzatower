<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        return response()->view('welcome', [
            'pizzas' => Pizza::all()
        ]);
    }
}
