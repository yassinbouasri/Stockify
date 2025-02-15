<?php

declare(strict_types=1);


namespace App\Actions\Stockify;

use App\Models\Product;
use Illuminate\Validation\ValidationException;


class OrderProductAttacher
{
    public function __construct(public DecrementProductStockQuantity $stockService)
    {
    }

    public function attachProduct($products, $order, array $quantities, array $maxQuantities )
    {
        foreach ($products as $product) {

            if ($maxQuantities[$product->id] < $quantities[$product->id] ) {
                throw ValidationException::withMessages([
                    'quantity' => ($maxQuantities[$product->id]) > 0
                        ?"{($product->name)} is out of stock! (Max: {$maxQuantities[$product->id]})"
                        :"{($product->name)} is out of stock!"
                ]);
            }

            if(!isset($quantities[$product->id])){
                $quantities[$product->id] = 1;
            }
            $totalAmount = $product->price->multiply($quantities[$product->id]);
            $order->products()->attach(
                $product,
                [
                    'quantity' => $quantities[$product->id],
                    'total_amount' => $totalAmount->getAmount(),
                ]);

            $this->stockService->decrement($product,$quantities[$product->id]);

        }

    }
}
