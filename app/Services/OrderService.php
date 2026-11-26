<?php

namespace App\Services;

use App\Models\Order;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class OrderService
{
    public function create(array $data): Order
    {
        return DB::transaction(function () use ($data) {
            $preparedItems = [];
            $totalPrice = 0;

            foreach ($data['items'] as $index => $itemData) {
                $variant = ProductVariant::query()
                    ->with('product')
                    ->whereHas('product', function ($query) {
                        $query->where('is_active', true);
                    })
                    ->find($itemData['variant_id']);

                if (!$variant || !$variant->product) {
                    throw ValidationException::withMessages([
                        "items.{$index}.variant_id" =>
                            'Один із товарів більше недоступний. Оновіть сторінку та спробуйте ще раз.',
                    ]);
                }

                $product = $variant->product;

                // Фотография должна принадлежать выбранному товару.
                // Разрешаем как фотографии конкретного варианта,
                // так и общие фотографии товара.
                $image = ProductImage::query()
                    ->where('id', $itemData['image_id'])
                    ->where('product_id', $product->id)
                    ->where(function ($query) use ($variant) {
                        $query->whereNull('product_variant_id')
                            ->orWhere('product_variant_id', $variant->id);
                    })
                    ->first();

                if (!$image) {
                    throw ValidationException::withMessages([
                        "items.{$index}.image_id" =>
                            'Фотографія не відповідає вибраному товару. Оновіть сторінку та виберіть її знову.',
                    ]);
                }

                $quantity = (int) $itemData['quantity'];
                $unitPrice = (int) $variant->price;
                $lineTotal = $unitPrice * $quantity;

                $preparedItems[] = [
                    'product_id' => $product->id,
                    'product_variant_id' => $variant->id,
                    'product_image_id' => $image->id,

                    'product_title' => $product->title,
                    'product_slug' => $product->slug,
                    'variant_name' => $variant->name,
                    'box_size' => $variant->box_size,
                    'flowers_count' => $variant->flowers_count,

                    'image_path' => $image->path,

                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'total_price' => $lineTotal,
                ];

                $totalPrice += $lineTotal;
            }

            $firstItem = $preparedItems[0];

            $order = Order::create([
                'name' => $data['name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'comment' => $data['comment'] ?? null,

                // Заполняем старые поля первой позицией заказа.
                // Они остаются для совместимости с прежней структурой.
                'product_variant_id' => $firstItem['product_variant_id'],
                'bouquet_slug' => $firstItem['product_slug'],
                'bouquet_title' => $firstItem['product_title'],
                'size' => mb_substr($firstItem['variant_name'], 0, 10),
                'price' => $firstItem['unit_price'],

                'total_price' => $totalPrice,
            ]);

            foreach ($preparedItems as $preparedItem) {
                $order->items()->create($preparedItem);
            }

            $order->load('items');

            Log::info('NEW ORDER', [
                'order_id' => $order->id,
                'name' => $order->name,
                'phone' => $order->phone,
                'email' => $order->email,
                'items_count' => $order->items->count(),
                'total_price' => $order->total_price,
            ]);

            return $order;
        });
    }
}
