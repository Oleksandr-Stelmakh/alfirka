<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class CatalogController extends Controller
{
    public function index(): Response
    {
        $products = Product::query()
            ->where('is_active', true)
            ->with([
                'category',
                'variants' => function ($query) {
                    $query->orderBy('sort_order');
                },
                'images' => function ($query) {
                    $query->orderBy('sort_order');
                },
            ])
            ->orderBy('sort_order')
            ->get();

        $products->each(function ($product) {
            $product->images->each(function ($image) {
                $image->path = Storage::url($image->path);
            });

            $product->variants->each(function ($variant) {
                $variant->images->each(function ($image) {
                    $image->path = Storage::url($image->path);
                });
            });
        });

        return Inertia::render('Gallery/Index', [
            'products' => $products,
        ]);
    }
}
