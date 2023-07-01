<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Status;
use App\Support\HasAdvancedFilter;
use App\Trait\GetModelByUuid;
use App\Trait\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Store
 *
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string $phone
 * @property string $url
 * @property string|null $location
 * @property string|null $logo
 * @property string|null $banner_image
 * @property mixed|null $social_links
 * @property Status $status
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Review> $reviews
 * @property-read int|null $reviews_count
 * @property-read \App\Models\Subscription|null $subscription
 * @property-read \App\Models\User|null $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Store advancedFilter($data)
 * @method static \Database\Factories\StoreFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Store newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Store newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Store query()
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereBannerImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereSocialLinks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereUuid($value)
 *
 * @property string $slug
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Payment> $payments
 * @property-read int|null $payments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Review> $reviews
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereSlug($value)
 *
 * @mixin \Eloquent
 */
class Store extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use HasFactory;
    use GetModelByUuid;
    use UuidGenerator;

    public $table = 'stores';

    public $orderable = [
        'id',
    ];

    public $filterable = [
        'id',
    ];

    protected $fillable = [
        'name',
        'url',
        'phone',
        'slug',

        'social_links',
        'location',
        'banner_image',
        'logo',

        'status',
        'user_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'social_links' => 'array',
        'status'       => Status::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
}
