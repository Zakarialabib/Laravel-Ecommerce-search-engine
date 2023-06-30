<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;

/**
 * App\Models\Menu
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property string $label
 * @property string $url
 * @property string $type
 * @property string|null $placement
 * @property int|null $sort_order
 * @property int|null $parent_id
 * @property string|null $icon
 * @property int $new_window
 * @property int $status
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Menu> $children
 * @property-read int|null $children_count
 * @property-read Menu|null $parent
 * @method static \Illuminate\Database\Eloquent\Builder|Menu active()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu advancedFilter($data)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu query()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereNewWindow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu wherePlacement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereUrl($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Menu> $children
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Menu> $children
 * @mixin \Eloquent
 */
class Menu extends Model
{
    use HasAdvancedFilter;

    public const ATTRIBUTES = [
        'id', 'name', 'type',
    ];

    public $orderable = self::ATTRIBUTES;
    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'name', 'label', 'url', 'type', 'sort_order', 'parent_id', 'new_window',
    ];

    public function scopeActive($query): void
    {
        $query->where('status', true);
    }

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }
}
