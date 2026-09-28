<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Jobs\SendEmailNotification;
use App\Jobs\SendTelegramNotification;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    public function store(
        StoreOrderRequest $request,
        OrderService $orderService,
    ): RedirectResponse {

        $validated = $request->validated();

        $order = $orderService->create($validated);

        $orderData = [
            'order_id' => $order->id,

            'date_time' => Carbon::now()->format('d.m.Y H:i'),

            'name' => $order->name,
            'phone' => $order->phone,
            'email' => $order->email,
            'comment' => $order->comment,

            'product_variant_id' => $order->product_variant_id,
            
            'bouquet_slug' => $order->bouquet_slug,
            'bouquet_title' => $order->bouquet_title,

            'size' => $order->size,
            'price' => $order->price,
        ];

        SendTelegramNotification::dispatch($orderData);
        SendEmailNotification::dispatch($orderData);

        return back()->with(
            'success',
            'Ваше замовлення успішно відправлено!'
        );
    }
}