<?php

namespace Components\Cart;

use Illuminate\Support\Facades\Facade;

class CartFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Cart::class;
    }
}
