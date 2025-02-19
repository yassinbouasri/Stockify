<?php

declare(strict_types=1);


namespace App\Actions\Stockify;

use App\Models\Product;
use Illuminate\Validation\ValidationException;


class OrderProductAttacher
{
    public function __construct(public ProductStockQuantity $stockService)
    {
    }

    public function attachProduct($products, $order, array $quantities, array $maxQuantities )
    {
        foreach ($products as $product) {

            $quantity = $this->validateQuantity($maxQuantities[$product->id], $product, $quantities[$product->id]);


            $totalAmount = $product->price->multiply($quantity);
            $order->products()->attach(
                $product,
                [
                    'quantity' => $quantity,
                    'total_amount' => $totalAmount->getAmount(),
                ]);

            $this->stockService->decrement($product,$quantity);

        }

    }

    public function updateProduct($products, $order, array $quantities, array $maxQuantities)
    {
        foreach ($products as $product) {
            $quantity = $this->validateQuantity($maxQuantities[$product->id], $product, $quantities[$product->id]);

            $previousQuantity = $order->products()->where('product_id', $product->id)->first()->pivot->quantity ?? 0;
            $quantityDifference = $quantity - $previousQuantity;

            $totalAmount = $product->price->multiply($quantity);

            $order->products()->updateExistingPivot(
                $product,
                [
                'quantity' => $quantity,
                'total_amount' => $totalAmount->getAmount(),
            ]);

            if ($quantityDifference >= 0) {
                $this->stockService->increment($product,$quantityDifference);
            }
            elseif ($quantityDifference < 0) {
                $this->stockService->decrement($product,abs($quantityDifference));
            }

        }
    }

    private function validateQuantity($maxQuantities, $product, $quantity)
    {
        if ($maxQuantities < $quantity) {
            throw ValidationException::withMessages(
                [
                    'quantity' => ($maxQuantities) > 0
                        ? "{($product->name)} is out of stock! (Max: {$maxQuantities})"
                        : "{($product->name)} is out of stock!"
                ]
            );
        }
        if ($quantity <= 0 ){
            throw ValidationException::withMessages(
                [
                    'quantity' => 'The quantity must be greater than 0.',
                ]);
        }

        if(!isset($quantity)){
            $quantity = 1;
        }

        return $quantity;
    }

}
