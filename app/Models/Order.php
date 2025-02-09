<?php

namespace App\Models;

use App\Casts\MoneyCast;
use App\Enums\PaymentMethod;
use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        return $this->belongsToMany(Product::class, 'order_product');
    }


}
