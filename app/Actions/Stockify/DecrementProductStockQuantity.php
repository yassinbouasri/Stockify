<?php

declare(strict_types=1);


namespace App\Actions\Stockify;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Collection;

class DecrementProductStockQuantity
{
    public function decrement(Collection $products, int $quantity): void
    {
        foreach ($products as $product) {
            foreach ($product->stocks as $stock) {
                $stock->decrement('quantity', $quantity);
            }

        }
    }

}
