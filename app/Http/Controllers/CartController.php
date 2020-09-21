<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add($id)
    {
        $pizza = Pizza::findOrFail($id);
        $row = \CartService::add($pizza->id, $pizza->name, request('quantity'), $pizza->price, session()->get('currency', 'usd'));

        return redirect('/')->with('success', 'Item added to cart');
    }

    public function plus($id)
    {
        $item = \CartService::get($id);
        \CartService::update($id, $item->qty + 1);
        return redirect()->back();
    }

    public function minus($id)
    {
        $item = \CartService::get($id);
        \CartService::update($id, $item->qty - 1);
        return redirect()->back();
    }

    public function remove($id)
    {
        \CartService::remove($id);
        return redirect()->back();
    }
}
