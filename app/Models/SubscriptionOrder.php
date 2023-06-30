<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use App\Trait\GetModelByUuid;
use App\Trait\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SubscriptionOrder
 *
 * @property int $id
 * @property string $uuid
 * @property string $payment_method
 * @property string $payment_status
 * @property string $amount
 * @property int $user_id
 * @property int $subscription_id
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\Subscription $subscription
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionOrder advancedFilter($data)
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionOrder whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionOrder whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionOrder wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionOrder wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionOrder whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionOrder whereSubscriptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionOrder whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionOrder whereUuid($value)
 * @mixin \Eloquent
 */
class SubscriptionOrder extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use UuidGenerator;
    use GetModelByUuid;

    public const ATTRIBUTES = [
        'id',
        'payment_method',
        'payment_status',
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
        'user_id',
        'subscription_id',
        'payment_method',
        'payment_status',
        'amount',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}
