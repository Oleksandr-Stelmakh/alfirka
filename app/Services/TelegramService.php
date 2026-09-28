<?php

namespace App\Services;

use App\Models\ProductVariant;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class TelegramService
{
    public function sendMessage(string $message): void
    {

        Http::post(
            'https://api.telegram.org/bot' .
            config('services.telegram.bot_token') .
            '/sendMessage',
            [
                'chat_id' => config('services.telegram.chat_id'),
                'text' => $message,
                'parse_mode' => 'HTML',
            ]
        )->throw();
    }

    public function sendPhoto(
        string $photoPath,
        string $caption = ''
    ): void {

        Http::attach(
            'photo',
            fopen($photoPath, 'r'),
            basename($photoPath)
        )->post(
            'https://api.telegram.org/bot' .
            config('services.telegram.bot_token') .
            '/sendPhoto',
            [
                'chat_id' =>
                    config('services.telegram.chat_id'),

                'caption' =>
                    $caption,

                'parse_mode' =>
                    'HTML',
            ]
        )->throw();
    }

    public function sendOrderNotification(array $order): void
    {

        $variant = ProductVariant::query()
            ->with([
                'images' => function ($query) {
                    $query->orderBy('sort_order');
                },
                'product.images' => function ($query) {
                    $query->orderBy('sort_order');
                },
            ])
            ->findOrFail($order['product_variant_id']);

        $mainImage = $variant->images->first(
            fn ($image) => $image->is_main
        ) ?? $variant->images->first();

        if (!$mainImage) {
            $mainImage = $variant->product->images->first(
                fn ($image) => $image->is_main
            ) ?? $variant->product->images->first();
        }

        $photoPath = $mainImage
            ? Storage::disk('public')->path($mainImage->path)
            : null;

        $comment = $order['comment'] ?: 'Не вказано';

        $message = <<<HTML
🌸 <b>Нове замовлення!</b>

📅 <b>Дата та час:</b> {$order['date_time']}
~~~~~~~~~~~~~~~~~~~~~~

👤 <b>Ім'я:</b>
 {$order['name']}

📞 <b>Телефон:</b>
 {$order['phone']}

📧 <b>Email:</b>
 {$order['email']}

💐 <b>Букет:</b>
 {$order['bouquet_title']}

📦 <b>Розмір:</b>
 {$order['size']}

💰 <b>Ціна:</b>
 {$order['price']} грн

💬 <b>Коментар:</b>
 {$comment}
HTML;

        if ($photoPath && file_exists($photoPath)) {
            $this->sendPhoto(
                $photoPath,
                $message
            );

            return;
        }

        $this->sendMessage($message);
    }
}