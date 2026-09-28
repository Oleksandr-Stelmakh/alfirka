<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class ProductVariantController extends Controller
{
    public function create(Product $product): Response
    {
        return Inertia::render('Admin/ProductVariants/Create', [
            'product' => $product,
        ]);
    }

    public function store(
        Request $request,
        Product $product
    ): RedirectResponse {
        $data = $request->validate([
    'name' => ['required', 'string', 'max:50'],
    'box_size' => ['nullable', 'string', 'max:50'],
    'flowers_count' => ['nullable', 'integer', 'min:0'],
    'price' => ['required', 'integer', 'min:0'],
    'sort_order' => ['required', 'integer', 'min:0'],
    ], [
        'name.required' => 'Введіть назву варіанту.',
        'name.string' => 'Назва варіанту має бути текстом.',
        'name.max' => 'Назва варіанту не може містити більше 50 символів.',

        'box_size.string' => 'Розмір коробки має бути текстом.',
        'box_size.max' => 'Розмір коробки не може містити більше 50 символів.',

        'flowers_count.integer' => 'Кількість квітів має бути цілим числом.',
        'flowers_count.min' => 'Кількість квітів не може бути менше 0.',

        'price.required' => 'Введіть ціну.',
        'price.integer' => 'Ціна має бути цілим числом.',
        'price.min' => 'Ціна не може бути менше 0.',

        'sort_order.required' => 'Вкажіть порядок сортування.',
        'sort_order.integer' => 'Порядок сортування має бути цілим числом.',
        'sort_order.min' => 'Порядок сортування не може бути менше 0.',
    ]);

        $product->variants()->create($data);

        return redirect()
            ->route('admin.products.edit', $product)
            ->with('success', 'Варіант створено.');
    }

    public function edit(
        Product $product,
        ProductVariant $variant
    ): Response {
        abort_unless(
            $variant->product_id === $product->id,
            404
        );

        $variant->load([
            'images' => function ($query) {
                $query
                    ->orderBy('sort_order')
                    ->orderBy('id');
            },
    ]);

    return Inertia::render('Admin/ProductVariants/Edit', [
        'product' => $product,
        'variant' => $variant,
    ]);
}

    public function update(
        Request $request,
        Product $product,
        ProductVariant $variant
    ): RedirectResponse {
        abort_unless(
            $variant->product_id === $product->id,
            404
        );

        $data = $request->validate([
    'name' => ['required', 'string', 'max:50'],
    'box_size' => ['nullable', 'string', 'max:50'],
    'flowers_count' => ['nullable', 'integer', 'min:0'],
    'price' => ['required', 'integer', 'min:0'],
    'sort_order' => ['required', 'integer', 'min:0'],
    ], [
        'name.required' => 'Введіть назву варіанту.',
        'name.string' => 'Назва варіанту має бути текстом.',
        'name.max' => 'Назва варіанту не може містити більше 50 символів.',

        'box_size.string' => 'Розмір коробки має бути текстом.',
        'box_size.max' => 'Розмір коробки не може містити більше 50 символів.',

        'flowers_count.integer' => 'Кількість квітів має бути цілим числом.',
        'flowers_count.min' => 'Кількість квітів не може бути менше 0.',

        'price.required' => 'Введіть ціну.',
        'price.integer' => 'Ціна має бути цілим числом.',
        'price.min' => 'Ціна не може бути менше 0.',

        'sort_order.required' => 'Вкажіть порядок сортування.',
        'sort_order.integer' => 'Порядок сортування має бути цілим числом.',
        'sort_order.min' => 'Порядок сортування не може бути менше 0.',
    ]);

        $variant->update($data);

        return redirect()
            ->route('admin.products.edit', $product)
            ->with('success', 'Варіант оновлено.');
    }

    public function destroy(
        Product $product,
        ProductVariant $variant
    ): RedirectResponse {
        abort_unless(
            $variant->product_id === $product->id,
            404
        );

        $variant->load('images');

        foreach ($variant->images as $image) {
            Storage::disk('public')->delete($image->path);
            $image->delete();
        }

        $variant->delete();

        return redirect()
            ->route('admin.products.edit', $product)
            ->with('success', 'Варіант товару видалено.');
    }
}