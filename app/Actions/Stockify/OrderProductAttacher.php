<?php

declare(strict_types=1);


namespace App\Actions\Stockify;

use App\Models\Product;

class OrderProductAttacher
{
    public function __construct(public DecrementProductStockQuantity $stockService)
    {
    }

    public function attachProduct($products, $order, $quantity )
    {
        foreach ($products as $product) {

            $totalAmount = $product->price->multiply($quantity);
            $order->products()->attach(
                $product,
                [
                    'quantity' => $quantity,
                    'total_amount' => $totalAmount->getAmount(),
                ]);
        }
        $this->stockService->decrement($products, $quantity);

    }
}
