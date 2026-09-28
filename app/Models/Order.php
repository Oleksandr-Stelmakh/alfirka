<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public const UPDATED_AT = null;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'comment',

        'product_variant_id',
        
        'bouquet_slug',
        'bouquet_title',

        'size',

        'price',
    ];
}
