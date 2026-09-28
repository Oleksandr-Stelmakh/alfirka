<?php


use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductVariantController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController as PublicProductController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



Route::get('/', function () {
    return Inertia::render('Home/Index');
})->name('home');

Route::get('/gallery', [
    CatalogController::class,
    'index',
])->name('gallery');

Route::get('/coffee-shop', function () {
    return Inertia::render('CoffeeShop/Index');
})->name('coffee-shop');

Route::get('/about', function () {
    return Inertia::render('About/Index');
})->name('about');

Route::get('/contacts', function () {
    return Inertia::render('Contacts/Index');
})->name('contacts');

Route::get('/products/{slug}', [
    PublicProductController::class,
    'show',
])->name('products.show');

Route::post('/orders', [OrderController::class, 'store'])
    ->name('orders.store');

Route::get('/admin/login', [
    AuthController::class,
    'showLogin',
])->name('admin.login');

Route::post('/admin/login', [
    AuthController::class,
    'login',
])->name('admin.login.store');

Route::get('/admin', [DashboardController::class, 'index'])
    ->middleware('admin')
    ->name('admin.dashboard');

Route::post('/admin/logout', [
    AuthController::class,
    'logout',
])->name('admin.logout');



Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/admins', [
        AdminController::class,
        'index',
    ])->name('admins.index');

    Route::get('/admins/create', [
        AdminController::class,
        'create',
    ])->name('admins.create');

    Route::post('/admins', [
        AdminController::class,
        'store',
    ])->name('admins.store');

    Route::get('/admins/{user}/edit', [
        AdminController::class,
        'edit',
    ])->name('admins.edit');

    Route::put('/admins/{user}', [
        AdminController::class,
        'update',
    ])->name('admins.update');

    Route::delete('/admins/{user}', [
        AdminController::class,
        'destroy',
    ])->name('admins.destroy');



   Route::get('/categories', [
        CategoryController::class,
        'index',
    ])->name('categories.index');

    Route::get('/categories/create', [
        CategoryController::class,
        'create',
    ])->name('categories.create');

    Route::post('/categories', [
        CategoryController::class,
        'store',
    ])->name('categories.store');

    Route::get('/categories/{category}/edit', [
        CategoryController::class,
        'edit',
    ])->name('categories.edit');

    Route::put('/categories/{category}', [
        CategoryController::class,
        'update',
    ])->name('categories.update');

    Route::delete('/categories/{category}', [
        CategoryController::class,
        'destroy',
    ])->name('categories.destroy');



    Route::get('/products', [
        ProductController::class,
        'index',
    ])->name('products.index');

    Route::get('/products/create', [
        ProductController::class,
        'create',
    ])->name('products.create');

    Route::post('/products', [
        ProductController::class,
        'store',
    ])->name('products.store');

    Route::get('/products/{product}/edit', [
        ProductController::class,
        'edit',
    ])->name('products.edit');

    Route::put('/products/{product}', [
        ProductController::class,
        'update',
    ])->name('products.update');

    Route::delete('/products/{product}', [
        ProductController::class,
        'destroy',
    ])->name('products.destroy');



    Route::get('/products/{product}/variants/create', [
        ProductVariantController::class,
        'create',
    ])->name('products.variants.create');

    Route::post('/products/{product}/variants', [
        ProductVariantController::class,
        'store',
    ])->name('products.variants.store');

    Route::get('/products/{product}/variants/{variant}/edit', [
        ProductVariantController::class,
        'edit',
    ])->name('products.variants.edit');

    Route::put('/products/{product}/variants/{variant}', [
        ProductVariantController::class,
        'update',
    ])->name('products.variants.update');

    Route::delete('/products/{product}/variants/{variant}', [
        ProductVariantController::class,
        'destroy',
    ])->name('products.variants.destroy');



    Route::post('/products/{product}/images', [
        ProductImageController::class,
        'store',
    ])->name('products.images.store');

    Route::post('/products/{product}/images/{image}/main', [
        ProductImageController::class,
        'setMain',
    ])->name('products.images.main');

    Route::delete('/products/{product}/images/{image}', [
        ProductImageController::class,
        'destroy',
    ])->name('products.images.destroy');

    Route::post('/products/{product}/variants/{variant}/images', [
        ProductImageController::class,
        'storeForVariant',
    ])->name('products.variants.images.store');

    Route::post('/products/{product}/variants/{variant}/images/{image}/main', [
        ProductImageController::class,
        'setMainForVariant',
    ])->name('products.variants.images.main');

    Route::delete('/products/{product}/variants/{variant}/images/{image}', [
        ProductImageController::class,
        'destroyForVariant',
    ])->name('products.variants.images.destroy');
});