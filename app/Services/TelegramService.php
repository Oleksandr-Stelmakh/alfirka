<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;
use Throwable;

class TelegramService
{
    public function __construct(
        private OrderCardImageService $orderCardImageService
    ) {
    }

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
        if (!is_file($photoPath)) {
            throw new RuntimeException(
                'Файл зображення для Telegram не знайдено.'
            );
        }

        $photo = fopen($photoPath, 'r');

        if ($photo === false) {
            throw new RuntimeException(
                'Не вдалося відкрити зображення для Telegram.'
            );
        }

        try {
            Http::attach(
                'photo',
                $photo,
                basename($photoPath)
            )->post(
                'https://api.telegram.org/bot' .
                config('services.telegram.bot_token') .
                '/sendPhoto',
                [
                    'chat_id' => config('services.telegram.chat_id'),
                    'caption' => $caption,
                    'parse_mode' => 'HTML',
                ]
            )->throw();
        } finally {
            fclose($photo);
        }
    }

    /**
     * Надсилає замовлення до Telegram у вигляді однієї картки.
     * Якщо створити картку не вдасться, надсилає текстове повідомлення.
     */
    public function sendOrderNotification(array $order): void
    {
        $cardPath = null;

        try {
            // Створюємо зображення з усіма товарами замовлення.
            $cardPath = $this->orderCardImageService->create($order);

            // Надсилаємо одну готову картку до Telegram.
            $caption = '🌸 <b>Нове замовлення №'
                . (int) ($order['order_id'] ?? 0)
                . '</b>';

            $this->sendPhoto($cardPath, $caption);
        } catch (Throwable $exception) {
            Log::error('Не вдалося надіслати картку замовлення до Telegram.', [
                'order_id' => $order['order_id'] ?? null,
                'error' => $exception->getMessage(),
            ]);

            // Якщо картку створити або надіслати не вдалося,
            // надсилаємо повну інформацію про замовлення текстом.
            $this->sendMessage(
                $this->buildTextMessage($order)
            );
        } finally {
            // Видаляємо тимчасове зображення після відправлення.
            if ($cardPath && is_file($cardPath)) {
                @unlink($cardPath);
            }
        }
    }

    /**
     * Формує текстове повідомлення на випадок помилки з карткою.
     */
    private function buildTextMessage(array $order): string
    {
        $escape = fn ($value) => htmlspecialchars(
            (string) ($value ?? ''),
            ENT_QUOTES | ENT_SUBSTITUTE,
            'UTF-8'
        );

        $message = "🌸 <b>Нове замовлення №"
            . (int) ($order['order_id'] ?? 0)
            . "!</b>\n";

        $message .= "📅 <b>Дата та час:</b> "
            . $escape($order['date_time'] ?? '—')
            . "\n";

        $message .= "~~~~~~~~~~~~~~~~~~~~~~\n";

        $message .= "👤 <b>Ім'я:</b> "
            . $escape($order['name'] ?? '—')
            . "\n";

        $message .= "📞 <b>Телефон:</b> "
            . $escape($order['phone'] ?? '—')
            . "\n";

        $message .= "📧 <b>Електронна пошта:</b> "
            . $escape($order['email'] ?? '—')
            . "\n";

        $message .= "~~~~~~~~~~~~~~~~~~~~~~\n";
        $message .= "🛍 <b>Склад замовлення:</b>\n";

        foreach (($order['items'] ?? []) as $index => $item) {
            $number = $index + 1;

            $quantity = (int) ($item['quantity'] ?? 1);
            $unitPrice = (float) ($item['unit_price'] ?? 0);
            $totalPrice = (float) ($item['total_price'] ?? 0);

            $message .= "\n<b>{$number}. "
                . $escape($item['product_title'] ?? 'Товар')
                . "</b>\n";

            $message .= "📦 Варіант: "
                . $escape($item['variant_name'] ?? '—')
                . "\n";

            if (!empty($item['box_size'])) {
                $message .= "📐 Розмір коробки: "
                    . $escape($item['box_size'])
                    . "\n";
            }

            if (!empty($item['flowers_count'])) {
                $message .= "🌷 Кількість квітів: "
                    . $escape($item['flowers_count'])
                    . "\n";
            }

            $message .= "🔢 Кількість: {$quantity} шт.\n";

            $message .= "💰 Ціна за одиницю: "
                . number_format($unitPrice, 0, ',', ' ')
                . " грн\n";

            $message .= "💵 Сума позиції: "
                . number_format($totalPrice, 0, ',', ' ')
                . " грн\n";
        }

        $total = number_format(
            (float) ($order['total_price'] ?? 0),
            0,
            ',',
            ' '
        );

        $comment = $order['comment'] ?: 'Не вказано';

        $message .= "\n~~~~~~~~~~~~~~~~~~~~~~\n";
        $message .= "💰 <b>Загальна сума: {$total} грн</b>\n";
        $message .= "💬 <b>Коментар:</b> " . $escape($comment);

        return $message;
    }
}


// Старий варіант реалізації збережено для довідки.

/*
// <?php

// namespace App\Services;

// use Illuminate\Support\Facades\Http;
// use Illuminate\Support\Facades\Storage;

// class TelegramService
// {
//     public function sendMessage(string $message): void
//     {
//         Http::post(
//             'https://api.telegram.org/bot' .
//             config('services.telegram.bot_token') .
//             '/sendMessage',
//             [
//                 'chat_id' => config('services.telegram.chat_id'),
//                 'text' => $message,
//                 'parse_mode' => 'HTML',
//             ]
//         )->throw();
//     }

//     public function sendPhoto(string $photoPath, string $caption = ''): void
//     {
//         $photo = file_get_contents($photoPath);

//         Http::attach(
//             'photo',
//             $photo,
//             basename($photoPath)
//         )->post(
//             'https://api.telegram.org/bot' .
//             config('services.telegram.bot_token') .
//             '/sendPhoto',
//             [
//                 'chat_id' => config('services.telegram.chat_id'),
//                 'caption' => $caption,
//                 'parse_mode' => 'HTML',
//             ]
//         )->throw();
//     }

//     public function sendOrderNotification(array $order): void
//     {
//         $escape = fn ($value) => htmlspecialchars(
//             (string) ($value ?? ''),
//             ENT_QUOTES | ENT_SUBSTITUTE,
//             'UTF-8'
//         );

//         $comment = $order['comment'] ?: 'Не вказано';

//         $message = "🌸 <b>Нове замовлення №{$order['order_id']}!</b>\n";
//         $message .= "📅 <b>Дата та час:</b> {$escape($order['date_time'])}\n";
//         $message .= "~~~~~~~~~~~~~~~~~~~~~~\n";

//         $message .= "👤 <b>Ім'я:</b> {$escape($order['name'])}\n";
//         $message .= "📞 <b>Телефон:</b> {$escape($order['phone'])}\n";
//         $message .= "📧 <b>Email:</b> {$escape($order['email'])}\n";
//         $message .= "~~~~~~~~~~~~~~~~~~~~~~\n";

//         $message .= "🛍 <b>Склад замовлення:</b>\n";

//         foreach ($order['items'] as $index => $item) {
//             $number = $index + 1;

//             $message .= "\n<b>{$number}. {$escape($item['product_title'])}</b>\n";
//             $message .= "📦 Варіант: {$escape($item['variant_name'])}\n";

//             if (!empty($item['box_size'])) {
//                 $message .= "📐 Коробка: {$escape($item['box_size'])}\n";
//             }

//             if (!empty($item['flowers_count'])) {
//                 $message .= "🌷 Кількість квітів: {$escape($item['flowers_count'])}\n";
//             }

//             $message .= "🔢 Кількість: {$item['quantity']} шт.\n";
//             $message .= "💰 Ціна за одиницю: {$item['unit_price']} грн\n";
//             $message .= "💵 Сума позиції: {$item['total_price']} грн\n";
//         }

//         $message .= "\n~~~~~~~~~~~~~~~~~~~~~~\n";
//         $message .= "💰 <b>Загальна сума: {$order['total_price']} грн</b>\n";
//         $message .= "💬 <b>Коментар:</b> {$escape($comment)}";

//         // Сначала отправляем полный текст заказа.
//         $this->sendMessage($message);

//         // Затем отправляем выбранную фотографию каждой позиции.
//         foreach ($order['items'] as $index => $item) {
//             if (empty($item['image_path'])) {
//                 continue;
//             }

//             $photoPath = Storage::disk('public')->path(
//                 $item['image_path']
//             );

//             if (!file_exists($photoPath)) {
//                 continue;
//             }

//             $caption = "Замовлення №{$order['order_id']}\n";
//             $caption .= $escape($item['product_title']) . "\n";
//             $caption .= "Варіант: " . $escape($item['variant_name']) . "\n";
//             $caption .= "Кількість: {$item['quantity']} шт.";

//             $this->sendPhoto($photoPath, $caption);
//         }
//     }
// }
*/
