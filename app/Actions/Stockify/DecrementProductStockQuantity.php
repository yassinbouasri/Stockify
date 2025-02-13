<?php

declare(strict_types=1);


namespace App\Actions\Stockify;

class DecrementProductStockQuantity
{
    public function decrement($product, int $quantity): void
    {

        foreach ($product->stocks as $stock) {
            $stock->decrement('quantity', $quantity);
        }


    }

}
