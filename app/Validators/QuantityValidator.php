<?php

declare(strict_types=1);


namespace App\Validators;

use Illuminate\Validation\ValidationException;

class QuantityValidator
{
    public static function validate($maxQuantities, $product, $quantity)
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