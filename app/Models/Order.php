<?php

namespace App\Models;

use App\Casts\MoneyCast;
use App\Enums\PaymentMethod;
use App\Enums\Status;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Money\Currency;
use Money\Money;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $casts = [
        'payment_method' => PaymentMethod::class,
        'status' => Status::class,
        'total_price' => MoneyCast::class,
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function products(): belongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->withPivot(['quantity', 'total_amount'])
            ->using(OrderProduct::class);
    }

    public function totalPrice(): Attribute
    {
        return Attribute::make(
            get: function (int $value) {
                return new Money($value, new Currency('USD'));
            }
        );
    }



}
