<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



Route::get('/', function () {
    return Inertia::render('Home/Index');
})->name('home');

Route::get('/gallery', function () {
    return Inertia::render('Gallery/Index');
})->name('gallery');

Route::get('/coffee-shop', function () {
    return Inertia::render('CoffeeShop/Index');
})->name('coffee-shop');

Route::get('/about', function () {
    return Inertia::render('About/Index');
})->name('about');

Route::get('/contacts', function () {
    return Inertia::render('Contacts/Index');
})->name('contacts');

Route::get('/products/{slug}', function (string $slug) {
    return Inertia::render('Product/Show', [
        'slug' => $slug,
    ]);
})->name('products.show');

Route::post('/orders', [OrderController::class, 'store'])
    ->name('orders.store');