<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use App\Trait\GetModelByUuid;
use App\Trait\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\VendorHighlighted
 *
 * @property int $id
 * @property string $uuid
 * @property string $placement_type
 * @property string $price
 * @property bool $approved
 * @property string|null $start_date
 * @property string|null $end_date
 * @property int|null $App\Models\User
 * @property int|null $App\Models\Product
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|VendorHighlighted advancedFilter($data)
 * @method static \Illuminate\Database\Eloquent\Builder|VendorHighlighted newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VendorHighlighted newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VendorHighlighted query()
 * @method static \Illuminate\Database\Eloquent\Builder|VendorHighlighted whereApp\Models\Product($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VendorHighlighted whereApp\Models\User($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VendorHighlighted whereApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VendorHighlighted whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VendorHighlighted whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VendorHighlighted whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VendorHighlighted whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VendorHighlighted wherePlacementType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VendorHighlighted wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VendorHighlighted whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VendorHighlighted whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VendorHighlighted whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VendorHighlighted whereUuid($value)
 *
 * @mixin \Eloquent
 */
class VendorHighlighted extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use UuidGenerator;
    use GetModelByUuid;

    public const ATTRIBUTES = [
        'id',
        'status',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public array $orderable = self::ATTRIBUTES;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public array $filterable = self::ATTRIBUTES;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'placement_type',
        'price',
        'approved',
        'start_date',
        'end_date',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'approved' => 'boolean',
        'status'   => 'boolean',
    ];
}
