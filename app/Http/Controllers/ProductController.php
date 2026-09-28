<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    public function show(string $slug): Response
    {
        $product = Product::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->with([
                'category',

                'variants' => function ($query) {
                    $query->orderBy('sort_order');
                },

                'images' => function ($query) {
                    $query->orderBy('sort_order');
                },

                'variants.images' => function ($query) {
                    $query->orderBy('sort_order');
                },
            ])
            ->firstOrFail();

        $product->images->each(function ($image) {
            $image->path = Storage::url($image->path);
        });

        $product->variants->each(function ($variant) {
            $variant->images->each(function ($image) {
                $image->path = Storage::url($image->path);
            });
        });

        return Inertia::render('Product/Show', [
            'product' => $product,
        ]);
    }
}