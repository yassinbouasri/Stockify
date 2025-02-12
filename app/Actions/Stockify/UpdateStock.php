<?php

declare(strict_types=1);


namespace App\Actions\Stockify;

use App\Models\Product;
use App\Models\Stock;

class UpdateStock
{
    public function saveStock(?Stock $stock, int $quantity, Product $product): void
    {
        if ($stock) {
            $stock->update(['quantity' => $quantity]);
        } else {
            Stock::create([
                'product_id' => $product->id,
                'quantity' => $quantity
                ]);
        }

    }

}
