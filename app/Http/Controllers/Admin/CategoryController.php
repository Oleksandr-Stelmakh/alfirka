<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{
    public function index(): Response
    {
        $categories = Category::query()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return Inertia::render('Admin/Categories/Index', [
            'categories' => $categories,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Categories/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
        'name' => [
            'required',
            'string',
            'max:255',
        ],
        'slug' => [
            'required',
            'string',
            'max:255',
            'unique:categories,slug',
        ],
        'is_active' => [
            'boolean',
        ],
        'sort_order' => [
            'required',
            'integer',
            'min:0',
        ],
        ], [
            'name.required' => 'Введіть назву категорії.',
            'name.string' => 'Назва категорії має бути текстом.',
            'name.max' => 'Назва категорії не може містити більше 255 символів.',

            'slug.required' => 'Введіть slug.',
            'slug.string' => 'Slug має бути текстом.',
            'slug.max' => 'Slug не може містити більше 255 символів.',
            'slug.unique' => 'Такий slug вже використовується.',

            'is_active.boolean' => 'Поле активності має містити коректне значення.',

            'sort_order.required' => 'Вкажіть порядок сортування.',
            'sort_order.integer' => 'Порядок сортування має бути цілим числом.',
            'sort_order.min' => 'Порядок сортування не може бути менше 0.',
        ]);

        Category::create($data);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Категорію створено');
    }

    public function edit(Category $category): Response
    {
        return Inertia::render('Admin/Categories/Edit', [
            'category' => $category,
        ]);
    }

    public function update(
        Request $request,
        Category $category
    ): RedirectResponse {
        $data = $request->validate([
        'name' => [
            'required',
            'string',
            'max:255',
        ],
        'slug' => [
            'required',
            'string',
            'max:255',
            'unique:categories,slug,' . $category->id,
        ],
        'is_active' => [
            'boolean',
        ],
        'sort_order' => [
            'required',
            'integer',
            'min:0',
        ],
        ], [
            'name.required' => 'Введіть назву категорії.',
            'name.string' => 'Назва категорії має бути текстом.',
            'name.max' => 'Назва категорії не може містити більше 255 символів.',

            'slug.required' => 'Введіть slug.',
            'slug.string' => 'Slug має бути текстом.',
            'slug.max' => 'Slug не може містити більше 255 символів.',
            'slug.unique' => 'Такий slug вже використовується.',

            'is_active.boolean' => 'Поле активності має містити коректне значення.',

            'sort_order.required' => 'Вкажіть порядок сортування.',
            'sort_order.integer' => 'Порядок сортування має бути цілим числом.',
            'sort_order.min' => 'Порядок сортування не може бути менше 0.',
        ]);

        $category->update($data);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Категорію оновлено');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Категорію видалено');
    }
}