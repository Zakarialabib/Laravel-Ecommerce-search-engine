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
        'store_id',
    ];

    public $filterable = [
        'id',
        'name',
        'plan',
        'duration',
        'status',
        'store_id',
    ];

    protected $fillable = [
        'name',
        'description',
        'features', // array
        'plan',
        'duration',
        'status',
        'store_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'status' => Status::class,
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
