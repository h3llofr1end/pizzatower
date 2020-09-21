<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const DEFAULT_SHIPPING_PRICE = 1.50;

    protected $guarded = [];

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
}
