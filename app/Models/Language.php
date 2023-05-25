<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    public const STATUS_ACTIVE = 1;

    public const STATUS_INACTIVE = 0;

    public const IS_DEFAULT = 1;

    public const IS_NOT_DEFAULT = 0;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'code',
        'status',
        'is_default',
    ];
}
