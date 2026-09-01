<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Log;

class OrderService
{
    public function create(array $data): Order
    {
        $order = Order::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'comment' => $data['comment'] ?? null,

            'bouquet_slug' => $data['bouquet_slug'],
            'bouquet_title' => $data['bouquet_title'],

            'size' => strtoupper($data['size_id']),
            'price' => $data['price'],
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