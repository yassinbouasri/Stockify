<?php

declare(strict_types=1);


namespace App\Actions\Stockify;

class ProductStockQuantity
{
    public function decrement($product, int $quantity): void
    {

        foreach ($product->stocks as $stock) {
            $stock->decrement('quantity', $quantity);
        }
    }

    public function increment($product, int $quantity): void
    {
        foreach ($product->stocks as $stock) {
            $stock->increment('quantity', $quantity);
        }
    }

}
