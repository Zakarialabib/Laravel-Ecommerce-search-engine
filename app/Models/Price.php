<?php

declare(strict_types=1);

namespace App\Models;

use App\Trait\GetModelByUuid;
use App\Trait\UuidGenerator;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Price
 *
 * @property int $id
 * @property string $uuid
 * @property string $price
 * @property string|null $old_price
 * @property string|null $wholesale_price
 * @property array|null $suggested_prices
 * @property int $product_id
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read mixed $discount
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PriceHistory> $priceHistories
 * @property-read int|null $price_histories_count
 * @property-read \App\Models\Product|null $product
 * @method static \Illuminate\Database\Eloquent\Builder|Price highestPrice()
 * @method static \Illuminate\Database\Eloquent\Builder|Price latestPrice()
 * @method static \Illuminate\Database\Eloquent\Builder|Price lowestPrice()
 * @method static \Illuminate\Database\Eloquent\Builder|Price newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Price newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Price query()
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereOldPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereSuggestedPrices($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereWholesalePrice($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PriceHistory> $priceHistories
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PriceHistory> $priceHistories
 * @mixin \Eloquent
 */
class Price extends Model
{
    use UuidGenerator;
    use GetModelByUuid;

    protected $fillable = [
        'price',
        'old_price',
        'wholesale_price',
        'suggested_prices',
        'product_id',
        'status',
    ];

    protected $casts = [
        'suggested_prices' => 'array',
        'status'           => 'boolean',
    ];

    public function product()
    {
        return $this->hasOne(Product::class);
    }

    public function priceHistories()
    {
        return $this->hasMany(PriceHistory::class);
    }

    public function scopeLatestPrice($query)
    {
        return $query->orderByDesc('created_at')->first();
    }

    public function getDiscountAttribute()
    {
        if ($this->old_price) {
            return round(($this->old_price - $this->price) / $this->old_price * 100);
        }

        return null;
    }

    /**
     * Scope a query to only include the product with the highest price.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHighestPrice($query)
    {
        return $query->orderBy('price', 'desc')->first();
    }

    /**
     * Scope a query to only include the product with the lowest price.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLowestPrice($query)
    {
        return $query->orderBy('price', 'asc')->first();
    }
}
