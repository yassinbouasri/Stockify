<?php

use App\Http\Controllers\PrintOrder;
use App\Livewire\CreateProduct;
use App\Livewire\Order;
use App\Livewire\OrderDetails;
use App\Livewire\OrderListing;
use App\Livewire\PrintOrderDetails;
use App\Livewire\ProductListing;
use App\Livewire\UpdateOrder;
use App\Livewire\UpdateProduct;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
}
);


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    }
    )->name('dashboard');

    Route::get('/products', ProductListing::class)->name('products');
    Route::get('/create-product', CreateProduct::class)->name('create-product');
    Route::get('update-product/{product}', UpdateProduct::class)->name('update-product');

    Route::get('/orders/create', Order::class)->name('create-order');
    Route::get('/order/{order}', OrderDetails::class)->name('order-details');

    Route::get('/order/{order}/print', PrintOrderDetails::class)->name('print-details');

    Route::get('/orders', OrderListing::class)->name('orders-listing');
    Route::get('/order/{order}', UpdateOrder::class)->name('update-order');


}
);
