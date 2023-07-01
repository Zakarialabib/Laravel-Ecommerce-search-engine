<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use App\Trait\GetModelByUuid;
use App\Trait\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PriceHistory
 *
 * @property int $id
 * @property string $uuid
 * @property \App\Models\Price $price
 * @property string $old_price
 * @property int $price_id
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PriceHistory advancedFilter($data)
 * @method static \Illuminate\Database\Eloquent\Builder|PriceHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PriceHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PriceHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|PriceHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PriceHistory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PriceHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PriceHistory whereOldPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PriceHistory wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PriceHistory wherePriceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PriceHistory whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PriceHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PriceHistory whereUuid($value)
 *
 * @mixin \Eloquent
 */
class PriceHistory extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use UuidGenerator;
    use GetModelByUuid;

    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected array $casts = [
        'status' => 'boolean',
    ];

    public function price()
    {
        return $this->belongsTo(Price::class);
    }
}
