<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::query()->where(['user_id' => Auth::id()])->latest()->get();

        return view('orders', ['orders' => $orders]);
    }

    public function create()
    {
        $order = Order::create([
            'address' => request('address'),
            'name' => request('name'),
            'surname' => request('surname'),
            'email' => request('email'),
            'total' => \CartService::total() + Order::DEFAULT_SHIPPING_PRICE,
            'currency' => session()->get('currency', 'usd'),
            'user_id' => Auth::id() ?? null,
        ]);

        foreach(\CartService::all() as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->id,
                'quantity' => $item->qty,
                'total' => $item->total
            ]);
        }

        \CartService::destroy();

        return redirect()->back()->with('success', 'Your order was confirmed.');
    }
}
