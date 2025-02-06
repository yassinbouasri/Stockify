<?php

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;


test('order products test', function () {

    $order = \App\Models\Order::factory()->create();

    $product = Product::factory()->create();
    $order->products();

    $this->assertDatabaseCount('orders' ,1);
});


