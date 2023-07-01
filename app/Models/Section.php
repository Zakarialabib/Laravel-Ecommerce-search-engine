<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Section
 *
 * @property int $id
 * @property string $title
 * @property string|null $image
 * @property string|null $featured_title
 * @property string|null $subtitle
 * @property string|null $label
 * @property string|null $link
 * @property string|null $description
 * @property int $status
 * @property string|null $bg_color
 * @property string|null $page
 * @property string|null $position
 * @property int|null $language_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \App\Models\Language|null $language
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Section active()
 * @method static \Illuminate\Database\Eloquent\Builder|Section advancedFilter($data)
 * @method static \Illuminate\Database\Eloquent\Builder|Section newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Section newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Section query()
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereBgColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereFeaturedTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section wherePage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Section extends Model
{
    use HasAdvancedFilter;

    public const HOME_PAGE = 1;

    public const ABOUT_PAGE = 2;

    public const BRAND_PAGE = 3;

    public const BLOG_PAGE = 4;

    public const CATALOG_PAGE = 5;

    public const BRANDS_PAGE = 6;

    public const CONTACT_PAGE = 7;

    public const PRODUCT_PAGE = 8;

    public const PRIVACY_PAGE = 9;

    public $table = 'sections';

    public $orderable = [
        'id',
        'featured_title',
        'label',
        'status',
        'subtitle',
        'title',
        'description',
        'image',
        'bg_color',
        'position',
        'page',
        'link',
        'language_id',
    ];

    public $filterable = [
        'id',
        'featured_title',
        'label',
        'status',
        'subtitle',
        'title',
        'description',
        'image',
        'bg_color',
        'position',
        'page',
        'link',
        'language_id',
    ];

    protected $fillable = [
        'featured_title',
        'label',
        'status',
        'subtitle',
        'title',
        'description',
        'image',
        'bg_color',
        'position',
        'page',
        'link',
        'language_id',
    ];

    /** Scope a query to only include active products. */
    public function scopeActive(\Illuminate\Database\Eloquent\Builder $query): void
    {
        $query->where('status', 1);
    }

    public function language()
    {
        return $this->belongsTo('App\Models\Language');
    }
}
