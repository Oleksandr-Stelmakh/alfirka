<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    public function index(): Response
    {
        $products = Product::query()
            ->with('category')
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        return Inertia::render('Admin/Products/Index', [
            'products' => $products,
        ]);
    }

    public function create(): Response
    {
        $categories = Category::query()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return Inertia::render('Admin/Products/Create', [
            'categories' => $categories,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
    'category_id' => ['required', 'integer', 'exists:categories,id'],
    'title' => ['required', 'string', 'max:255'],
    'slug' => ['required', 'string', 'max:255', 'unique:products,slug'],
    'description' => ['nullable', 'string'],
    'full_description' => ['nullable', 'string'],
    'badge' => ['nullable', 'string', 'max:255'],
    'is_active' => ['boolean'],
    'sort_order' => ['required', 'integer', 'min:0'],
    ], [
        'category_id.required' => 'Оберіть категорію.',
        'category_id.integer' => 'Категорія має бути коректною.',
        'category_id.exists' => 'Обрана категорія не існує.',

        'title.required' => 'Введіть назву товару.',
        'title.string' => 'Назва товару має бути текстом.',
        'title.max' => 'Назва товару не може містити більше 255 символів.',

        'slug.required' => 'Введіть slug.',
        'slug.string' => 'Slug має бути текстом.',
        'slug.max' => 'Slug не може містити більше 255 символів.',
        'slug.unique' => 'Такий slug вже використовується.',

        'description.string' => 'Опис має бути текстом.',
        'full_description.string' => 'Детальний опис має бути текстом.',

        'badge.string' => 'Badge має бути текстом.',
        'badge.max' => 'Badge не може містити більше 255 символів.',

        'is_active.boolean' => 'Поле активності має містити коректне значення.',

        'sort_order.required' => 'Вкажіть порядок сортування.',
        'sort_order.integer' => 'Порядок сортування має бути цілим числом.',
        'sort_order.min' => 'Порядок сортування не може бути менше 0.',
    ]);

        Product::create($data);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Товар створено.');
    }

    public function edit(Product $product): Response
    {
      $categories = Category::query()
         ->orderBy('sort_order')
         ->orderBy('name')
         ->get();

      $product->load([
          'images' => function ($query) {
              $query
                  ->whereNull('product_variant_id')
                  ->orderBy('sort_order')
                  ->orderBy('id');
          },

          'variants' => function ($query) {
              $query
                  ->orderBy('sort_order')
                  ->orderBy('id');
          },
      ]);

      return Inertia::render('Admin/Products/Edit', [
         'product' => $product,
         'categories' => $categories,
      ]);
    }

    public function update(
        Request $request,
        Product $product
    ): RedirectResponse {

        $data = $request->validate([
    'category_id' => ['required', 'integer', 'exists:categories,id'],
    'title' => ['required', 'string', 'max:255'],
    'slug' => [
        'required',
        'string',
        'max:255',
        'unique:products,slug,' . $product->id,
    ],
    'description' => ['nullable', 'string'],
    'full_description' => ['nullable', 'string'],
    'badge' => ['nullable', 'string', 'max:255'],
    'is_active' => ['boolean'],
    'sort_order' => ['required', 'integer', 'min:0'],
    ], [
        'category_id.required' => 'Оберіть категорію.',
        'category_id.integer' => 'Категорія має бути коректною.',
        'category_id.exists' => 'Обрана категорія не існує.',

        'title.required' => 'Введіть назву товару.',
        'title.string' => 'Назва товару має бути текстом.',
        'title.max' => 'Назва товару не може містити більше 255 символів.',

        'slug.required' => 'Введіть slug.',
        'slug.string' => 'Slug має бути текстом.',
        'slug.max' => 'Slug не може містити більше 255 символів.',
        'slug.unique' => 'Такий slug вже використовується.',

        'description.string' => 'Опис має бути текстом.',
        'full_description.string' => 'Детальний опис має бути текстом.',

        'badge.string' => 'Badge має бути текстом.',
        'badge.max' => 'Badge не може містити більше 255 символів.',

        'is_active.boolean' => 'Поле активності має містити коректне значення.',

        'sort_order.required' => 'Вкажіть порядок сортування.',
        'sort_order.integer' => 'Порядок сортування має бути цілим числом.',
        'sort_order.min' => 'Порядок сортування не може бути менше 0.',
    ]);

    $product->update($data);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Товар оновлено.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->load('images');

        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->path);
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Товар видалено.');
    }
}