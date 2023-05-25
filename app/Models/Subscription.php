<?php

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;

class Subscription extends Model
{
    use HasFactory;
    use HasAdvancedFilter;

    public $table = 'subscriptions';

    public $orderable = [
        'id',
        'name',
        'plan',
        'duration',
        'status',
        'price',
    ];

    public $filterable = [
        'id',
        'name',
        'plan',
        'duration',
        'status',
        'price',
    ];

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
        'status' => Status::class,
        'features' => 'array',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)
                    ->withPivot('starts_at', 'ends_at')
                    ->withTimestamps();
    }
}
