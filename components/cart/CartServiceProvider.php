<?php

namespace Components\Cart;

use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Cart::class, function($app){
            return new Cart($app['session']);
        });

        $this->app->alias(Cart::class, 'cart');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public function provides()
    {
        return [Cart::class, 'cart'];
    }
}
