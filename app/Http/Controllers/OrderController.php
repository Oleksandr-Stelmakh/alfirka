<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Jobs\SendEmailNotification;
use App\Jobs\SendTelegramNotification;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    public function store(
        StoreOrderRequest $request,
        OrderService $orderService
    ): RedirectResponse {
        $validated = $request->validated();

        $order = $orderService->create($validated);

        $orderData = [
            'order_id' => $order->id,
            'date_time' => $order->created_at?->format('d.m.Y H:i'),

            'name' => $order->name,
            'phone' => $order->phone,
            'email' => $order->email,
            'comment' => $order->comment,

            'total_price' => $order->total_price,

            'items' => $order->items->map(function ($item) {
                return [
                    'product_title' => $item->product_title,
                    'product_slug' => $item->product_slug,
                    'variant_name' => $item->variant_name,
                    'box_size' => $item->box_size,
                    'flowers_count' => $item->flowers_count,

                    'quantity' => $item->quantity,
                    'unit_price' => $item->unit_price,
                    'total_price' => $item->total_price,

                    // Это исходный путь на диске public,
                    // а не URL для отображения в браузере.
                    'image_path' => $item->image_path,
                ];
            })->all(),
        ];

        SendTelegramNotification::dispatch($orderData);
        SendEmailNotification::dispatch($orderData);

        return back()->with(
            'success',
            'Ваше замовлення успішно відправлено!'
        );
    }
}
