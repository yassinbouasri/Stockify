<?php

declare(strict_types=1);


namespace App\Actions\Stockify;

use App\Models\Product;
use App\Validators\QuantityValidator;
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
        $syncData = [];
        if (count($products) === 0) {
            $products = $order->products;
        }
        foreach ($products as $product) {

            $quantity = QuantityValidator::validate($maxQuantities[$product->id], $product, $quantities[$product->id]);

            $previousQuantity = $order->products()->where('product_id', $product->id)->first()->pivot->quantity ?? 0;
            $quantityDifference = $quantity - $previousQuantity;

            $syncData[$product->id] = [
                'quantity' => $quantity,
                'total_amount' => $product->price->multiply($quantity)->getAmount()
            ];

           $this->syncPivot($order,$products);


            if ($quantityDifference >= 0) {
                $this->stockService->increment($product,$quantityDifference);
            }
            elseif ($quantityDifference < 0) {
                $this->stockService->decrement($product,abs($quantityDifference));
            }

        }

        $order->products()->syncWithoutDetaching($syncData);

    }

    private function syncPivot($order,  $products): void
    {
        foreach ($order->products as $p) {
            if (!array_key_exists($p->id, array_flip($products->pluck('id')->toArray()))) {
                $order->products()->detach($p->id);
            }
        }

    }

}
