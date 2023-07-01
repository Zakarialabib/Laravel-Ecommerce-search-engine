<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Popup
 *
 * @property int $id
 * @property string $name
 * @property string|null $width
 * @property string|null $background_color
 * @property string|null $frequency
 * @property string|null $timing
 * @property int|null $delay
 * @property int|null $duration
 * @property int|null $visits
 * @property string|null $content
 * @property string|null $cta_text
 * @property string|null $cta_url
 * @property bool $status
 * @property bool $is_default
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static Builder|Popup default()
 * @method static Builder|Popup newModelQuery()
 * @method static Builder|Popup newQuery()
 * @method static Builder|Popup query()
 * @method static Builder|Popup whereBackgroundColor($value)
 * @method static Builder|Popup whereContent($value)
 * @method static Builder|Popup whereCreatedAt($value)
 * @method static Builder|Popup whereCtaText($value)
 * @method static Builder|Popup whereCtaUrl($value)
 * @method static Builder|Popup whereDelay($value)
 * @method static Builder|Popup whereDuration($value)
 * @method static Builder|Popup whereFrequency($value)
 * @method static Builder|Popup whereId($value)
 * @method static Builder|Popup whereIsDefault($value)
 * @method static Builder|Popup whereName($value)
 * @method static Builder|Popup whereStatus($value)
 * @method static Builder|Popup whereTiming($value)
 * @method static Builder|Popup whereUpdatedAt($value)
 * @method static Builder|Popup whereVisits($value)
 * @method static Builder|Popup whereWidth($value)
 *
 * @mixin \Eloquent
 */
class Popup extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected array $fillable = [
        'width',
        'frequency',
        'timing',
        'delay',
        'duration',
        'backgroundColor',
        'content',
        'ctaText',
        'ctaUrl',
        'status',
        'is_default',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected array $casts = [
        'status'     => Status::class,
        'is_default' => 'boolean',
    ];

    public function scopeDefault($query): Builder
    {
        return $query->where('is_default', true)->first();
    }
}
