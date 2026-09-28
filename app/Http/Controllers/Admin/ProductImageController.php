<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    public function store(
        Request $request,
        Product $product
    ): RedirectResponse {
        $data = $request->validate([
        'image' => [
            'required',
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:10240',
        ],
        ], [
            'image.required' => 'Оберіть зображення.',
            'image.image' => 'Файл має бути зображенням.',
            'image.mimes' => 'Дозволені формати: JPG, JPEG, PNG, WEBP.',
            'image.max' => 'Розмір зображення не може перевищувати 10 МБ.',
        ]);

        $hasMainImage = $product->images()
            ->whereNull('product_variant_id')
            ->where('is_main', true)
            ->exists();

        $path = $data['image']->store('products', 'public');

        $product->images()->create([
            'product_variant_id' => null,
            'path' => $path,
            'is_main' => ! $hasMainImage,
            'sort_order' => $product->images()
                ->whereNull('product_variant_id')
                ->max('sort_order') + 1,
        ]);

        return redirect()
            ->route('admin.products.edit', $product)
            ->with('success', 'Фотографію додано.');
    }

    public function setMain(
        Product $product,
        ProductImage $image
    ): RedirectResponse {
        abort_unless(
            $image->product_id === $product->id
                && $image->product_variant_id === null,
            404
        );

        $product->images()
            ->whereNull('product_variant_id')
            ->update([
                'is_main' => false,
            ]);

        $image->update([
            'is_main' => true,
        ]);

        return redirect()
            ->route('admin.products.edit', $product)
            ->with('success', 'Головну фотографію змінено.');
    }

    public function destroy(
        Product $product,
        ProductImage $image
    ): RedirectResponse {
        abort_unless(
            $image->product_id === $product->id
                && $image->product_variant_id === null,
            404
        );

        Storage::disk('public')->delete($image->path);

        $wasMain = $image->is_main;

        $image->delete();

        if ($wasMain) {
            $nextImage = $product->images()
                ->whereNull('product_variant_id')
                ->orderBy('sort_order')
                ->orderBy('id')
                ->first();

            if ($nextImage) {
                $nextImage->update([
                    'is_main' => true,
                ]);
            }
        }

        return redirect()
            ->route('admin.products.edit', $product)
            ->with('success', 'Фотографію видалено.');
    }

    public function storeForVariant(
        Request $request,
        Product $product,
        ProductVariant $variant
    ): RedirectResponse {
        abort_unless(
            $variant->product_id === $product->id,
            404
        );

        $data = $request->validate([
        'image' => [
            'required',
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:10240',
        ],
        ], [
            'image.required' => 'Оберіть зображення.',
            'image.image' => 'Файл має бути зображенням.',
            'image.mimes' => 'Дозволені формати: JPG, JPEG, PNG, WEBP.',
            'image.max' => 'Розмір зображення не може перевищувати 10 МБ.',
        ]);

        $hasMainImage = $variant->images()
            ->where('is_main', true)
            ->exists();

        $path = $data['image']->store('products', 'public');

        $variant->images()->create([
            'product_id' => $product->id,
            'path' => $path,
            'is_main' => ! $hasMainImage,
            'sort_order' => $variant->images()->max('sort_order') + 1,
        ]);

        return redirect()
            ->route('admin.products.variants.edit', [
                $product,
                $variant,
            ])
            ->with('success', 'Фотографію варіанту додано.');
    }

    public function setMainForVariant(
        Product $product,
        ProductVariant $variant,
        ProductImage $image
    ): RedirectResponse {
        abort_unless(
            $variant->product_id === $product->id
                && $image->product_id === $product->id
                && $image->product_variant_id === $variant->id,
            404
        );

        $variant->images()->update([
            'is_main' => false,
        ]);

        $image->update([
            'is_main' => true,
        ]);

        return redirect()
            ->route('admin.products.variants.edit', [
                $product,
                $variant,
            ])
            ->with('success', 'Головну фотографію варіанту змінено.');
    }

    public function destroyForVariant(
        Product $product,
        ProductVariant $variant,
        ProductImage $image
    ): RedirectResponse {
        abort_unless(
            $variant->product_id === $product->id
                && $image->product_id === $product->id
                && $image->product_variant_id === $variant->id,
            404
        );

        Storage::disk('public')->delete($image->path);

        $wasMain = $image->is_main;

        $image->delete();

        if ($wasMain) {
            $nextImage = $variant->images()
                ->orderBy('sort_order')
                ->orderBy('id')
                ->first();

            if ($nextImage) {
                $nextImage->update([
                    'is_main' => true,
                ]);
            }
        }

        return redirect()
            ->route('admin.products.variants.edit', [
                $product,
                $variant,
            ])
            ->with('success', 'Фотографію варіанту видалено.');
    }
}