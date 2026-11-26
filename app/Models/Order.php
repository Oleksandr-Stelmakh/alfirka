<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    public const UPDATED_AT = null;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'comment',

        // Старые поля оставляем для совместимости.
        'product_variant_id',
        'bouquet_slug',
        'bouquet_title',
        'size',
        'price',

        // Общая стоимость всего заказа.
        'total_price',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
