<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'product_variant_id',
        'product_image_id',
        'product_title',
        'product_slug',
        'variant_name',
        'box_size',
        'flowers_count',
        'image_path',
        'quantity',
        'unit_price',
        'total_price',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function variant(): BelongsTo
    {
        return $this->belongsTo(
            ProductVariant::class,
            'product_variant_id'
        );
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(
            ProductImage::class,
            'product_image_id'
        );
    }
}
