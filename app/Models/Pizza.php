<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    use HasFactory;

    public function getPriceAttribute()
    {
        if(session()->get('currency') === 'eur') {
            $rate = ConvertCurrency::find(['id' => ConvertCurrency::DEFAULT_CURRENCY.':'.session()->get('currency')])->first();
            return number_format($this->price_usd * $rate->rate, 2);
        } else {
            return $this->price_usd;
        }
    }
}
