<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorHighlighted extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use UuidGenerator;
    use GetModelByUuid;

    const ATTRIBUTES = [
        'id',
        'status',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $orderable = self::ATTRIBUTES;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $filterable = self::ATTRIBUTES;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
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
        'status' => 'boolean',
    ];
}
