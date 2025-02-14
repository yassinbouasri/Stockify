<?php

use App\Livewire\CreateProduct;
use App\Livewire\Order;
use App\Livewire\OrderDetails;
use App\Livewire\ProductListing;
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

    Route::get('/products', ProductListing::class)->name('products');
    Route::get('/create-product', CreateProduct::class)->name('create-product');
    Route::get('update-product/{product}', UpdateProduct::class)->name('update-product');

    Route::get('/orders', Order::class)->name('orders');
    Route::get('/order/{order}', OrderDetails::class)->name('order-details');

});
