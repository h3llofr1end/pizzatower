<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConvertCurrency extends Model
{
    const DEFAULT_CURRENCY = 'usd';

    protected $primaryKey = 'id';

    protected $guarded = [];
}
