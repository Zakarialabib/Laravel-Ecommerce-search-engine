<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;

class Store extends Model
{
    use InteractsWithViews;
    use HasFactory;
    use Notifiable;
    use HasAdvancedFilter;

    public $table = 'stores';

    public $orderable = [
        'id',
    ];

    public $filterable = [
        'id',
    ];

    protected $fillable = [
        'store_owner',
        'store_name',
        'store_link',
        'store_phone',
        'store_social', // array of social media
        'store_address',
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

    public function products()
    {
        return $this->hasMany(Product::class, 'store_id', 'id');
    }    

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
}