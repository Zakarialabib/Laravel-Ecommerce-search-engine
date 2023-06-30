<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\EmailTemplate
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $message
 * @property string|null $default
 * @property mixed|null $placeholders
 * @property string|null $type
 * @property string|null $subject
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|EmailTemplate active()
 * @method static Builder|EmailTemplate advancedFilter($data)
 * @method static Builder|EmailTemplate default()
 * @method static Builder|EmailTemplate newModelQuery()
 * @method static Builder|EmailTemplate newQuery()
 * @method static Builder|EmailTemplate query()
 * @method static Builder|EmailTemplate whereCreatedAt($value)
 * @method static Builder|EmailTemplate whereDefault($value)
 * @method static Builder|EmailTemplate whereDescription($value)
 * @method static Builder|EmailTemplate whereId($value)
 * @method static Builder|EmailTemplate whereMessage($value)
 * @method static Builder|EmailTemplate whereName($value)
 * @method static Builder|EmailTemplate wherePlaceholders($value)
 * @method static Builder|EmailTemplate whereStatus($value)
 * @method static Builder|EmailTemplate whereSubject($value)
 * @method static Builder|EmailTemplate whereType($value)
 * @method static Builder|EmailTemplate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class EmailTemplate extends Model
{
    use HasAdvancedFilter;

    public const ATTRIBUTES = [
        'id',
        'name',
        'type',
        'subject',
    ];

    public $orderable = self::ATTRIBUTES;
    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'id',
        'name',
        'description',
        'message',
        'default',
        'placeholders',
        'type',
        'subject',
        'status',
    ];

    public function scopeDefault(Builder $query)
    {
        return $query->where('default', true);
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('status', 'active');
    }
}
