<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Shipping
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Shipping advancedFilter($data)
 * @method static \Illuminate\Database\Eloquent\Builder|Shipping newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Shipping newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Shipping query()
 * @mixin \Eloquent
 */
class Shipping extends Model
{
    use HasAdvancedFilter;

    public $orderable = [
        'id', 'is_pickup', 'title', 'subtitle', 'cost', 'status',
    ];

    public $timestamps = false;

    protected $filterable = [
        'id', 'is_pickup', 'title', 'subtitle', 'cost', 'status',
    ];

    protected $fillable = [
        'is_pickup', 'title', 'subtitle', 'cost', 'status',
    ];
}
