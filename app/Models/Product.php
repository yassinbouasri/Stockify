<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;
use Money\Currency;
use Money\Money;

class Product extends Model
{
    /** @use HasFactory<ProductFactory> */
    use HasFactory;
    use Searchable;

    protected $casts = [
        'price' => MoneyCast::class,
    ];

    public function price(): Attribute
    {
        return Attribute::make(
            get: function (int $value) {
                return new Money($value, new Currency('USD'));
            }
        );
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function stocks(): HasMany
    {
        return $this->hasMany(Stock::class);
    }

    public function orders(): belongsToMany
    {
        return $this->belongsToMany(Order::class)
            ->withPivot(['quantity','total_price'])
            ->using(OrderProduct::class);
    }

    public function toSearchableArray()
    {
        return array_merge($this->toArray(),[
            'id' => (string) $this->id,
            'category' => $this->category->name,
            'created_at' => $this->created_at->timestamp,
        ]);
    }

}
