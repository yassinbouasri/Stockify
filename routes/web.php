<?php

use App\Livewire\CreateProduct;
use App\Livewire\Orders;
use App\Livewire\ProductListings;
use App\Livewire\UpdateProduct;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/products', ProductListings::class)->name('products');
    Route::get('/create-product', CreateProduct::class)->name('create-product');
    Route::get('update-product/{product}', UpdateProduct::class)->name('update-product');

    Route::get('/orders', Orders::class)->name('orders');

});
