<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Trait\GetModelByUuid;
use App\Trait\UuidGenerator;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasAdvancedFilter;
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use GetModelByUuid;
    use UuidGenerator;

    public $orderable = [
        'id', 'name',   'city', 'country',
        'phone', 'email', 'password', 'created_at', 'updated_at',
    ];

    protected $filterable = [
        'name',   'city', 'country',
        'phone', 'email', 'password', 'created_at', 'updated_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id', 'name',   'city', 'country', 'address',
        'phone', 'email', 'password', 'created_at', 'updated_at','store_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return $this->roles->pluck('name')->contains(Role::ROLE_ADMIN);
    }

    public function isVendor()
    {
        return $this->roles->pluck('name')->contains(Role::ROLE_VENDOR);
    }
    
    public function isClient()
    {
        return $this->roles->pluck('name')->contains(Role::ROLE_CLIENT);
    }

    public function roles() 
    {
        return $this->belongsToMany(Role::class);
    }
    
    public function store()
    {
        return $this->hasOne(Store::class);
    }

    public function subscriptions()
    {
        return $this->belongsToMany(Subscription::class)
                    ->withPivot('starts_at', 'ends_at')
                    ->withTimestamps();
    }
    
    public function products()
    {
        return $this->hasMany(Product::class, 'user_id', 'id');
    }    

    public function highlightedProducts()
    {
        return $this->hasMany(VendorHighlighted::class);
    }


}
