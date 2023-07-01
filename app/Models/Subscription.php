<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;

/**
 * App\Models\Subscription
 *
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string|null $description
 * @property array|null $features
 * @property string $plan
 * @property int $duration
 * @property string|null $trial_duration
 * @property Status $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription advancedFilter($data)
 * @method static \Database\Factories\SubscriptionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription query()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereFeatures($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription wherePlan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereTrialDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereUuid($value)
 * @property string $price
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription wherePrice($value)
 * @mixin \Eloquent
 */
class Subscription extends Model
{
    use HasFactory;
    use HasAdvancedFilter;

    public $table = 'subscriptions';

    public const ATTRIBUTES = [
        'id',
        'name',
        'plan',
        'duration',
        'status',
        'price',
    ];

    public $orderable = self::ATTRIBUTES;
    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'name',
        'description',
        'features', // array
        'plan',
        'duration',
        'status',
        'trial_duration',
        'ends_at',
        'price',
    ];

    protected $casts = [
        'status'   => Status::class,
        'features' => 'array',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('starts_at', 'ends_at')
            ->withTimestamps();
    }
}
