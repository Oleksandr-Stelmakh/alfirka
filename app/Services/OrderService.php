<?php

namespace App\Services;

use App\Models\Order;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Log;

class OrderService
{
    public function create(array $data): Order
    {
        $variant = ProductVariant::query()
            ->whereHas('product', function ($query) {
                $query->where('is_active', true);
            })
            ->with('product')
            ->findOrFail($data['product_variant_id']);

        $product = $variant->product;

        $order = Order::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'comment' => $data['comment'] ?? null,

            // Данные определяются сервером из БД
            'product_variant_id' => $variant->id,
            'bouquet_slug' => $product->slug,
            'bouquet_title' => $product->title,
            'size' => $variant->name,
            'price' => $variant->price,
        ]);

        Log::info('NEW ORDER', [
            'order_id' => $order->id,
            'name' => $order->name,
            'phone' => $order->phone,
            'email' => $order->email,
            'bouquet' => $order->bouquet_title,
            'size' => $order->size,
            'price' => $order->price,
        ]);

        return $order;
    }
}