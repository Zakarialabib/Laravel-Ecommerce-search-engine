<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;
use App\Trait\GetModelByUuid;
use App\Trait\UuidGenerator;

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
        'social_links', // array of social media
        'location',
        'status',
        'banner_image',
        'logo',
        'user_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'status' => Status::class,
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