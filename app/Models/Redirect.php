<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\RedirectionStatus;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Redirect
 *
 * @property int $id
 * @property string $old_url
 * @property string|null $new_url
 * @property RedirectionStatus|null $http_status_code
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Redirect advancedFilter($data)
 * @method static \Illuminate\Database\Eloquent\Builder|Redirect newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Redirect newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Redirect query()
 * @method static \Illuminate\Database\Eloquent\Builder|Redirect whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Redirect whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Redirect whereHttpStatusCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Redirect whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Redirect whereNewUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Redirect whereOldUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Redirect whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Redirect whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Redirect extends Model
{
    use HasAdvancedFilter;

    public $orderable = [
        'id',
        'old_url',
        'new_url',
        'status',
        'created_at',
        'updated_at',
    ];
    public $filterable = [
        'id',
        'old_url',
        'new_url',
        'status',
        'created_at',
        'updated_at',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'old_url',
        'new_url',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status'           => 'boolean',
        'http_status_code' => RedirectionStatus::class,
    ];
}
