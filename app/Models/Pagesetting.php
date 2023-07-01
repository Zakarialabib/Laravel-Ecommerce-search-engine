<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Pagesetting
 *
 * @property int $id
 * @property string|null $header
 * @property string|null $footer
 * @property string|null $bottomBar
 * @property string|null $topHeader
 * @property string|null $bottomFooter
 * @property int $themeColor
 * @property int $popularProducts
 * @property int $flashDeal
 * @property int $bestSellers
 * @property int $topBrands
 * @property string $status
 * @property int|null $featured_banner_id
 * @property int|null $page_id
 * @property int|null $language_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \App\Models\FeaturedBanner|null $featuredBanner
 * @property-read \App\Models\Language|null $language
 * @property-read \App\Models\Page|null $page
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Pagesetting advancedFilter($data)
 * @method static \Illuminate\Database\Eloquent\Builder|Pagesetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pagesetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pagesetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pagesetting whereBestSellers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pagesetting whereBottomBar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pagesetting whereBottomFooter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pagesetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pagesetting whereFeaturedBannerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pagesetting whereFlashDeal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pagesetting whereFooter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pagesetting whereHeader($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pagesetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pagesetting whereLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pagesetting wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pagesetting wherePopularProducts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pagesetting whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pagesetting whereThemeColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pagesetting whereTopBrands($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pagesetting whereTopHeader($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pagesetting whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class PageSetting extends Model
{
    use HasAdvancedFilter;

    public $table = 'pagesettings';

    public $orderable = [
        'id', 'topbar', 'bottombar', 'topheader', 'bottomfooter',
        'popular_products', 'flash_deal', 'deal_of_the_day', 'best_sellers',
        'brands', 'top_big_trending', 'top_brand', // bool
        'status',
        'featured_banner_id',
        'page_id',
        'language_id',
    ];
    public $filterable = [
        'id', 'topbar', 'bottombar', 'topheader', 'bottomfooter',
        'popular_products', 'flash_deal', 'deal_of_the_day', 'best_sellers',
        'brands', 'top_big_trending', 'top_brand', // bool
        'status',
        'featured_banner_id',
        'page_id',
        'language_id',
    ];
    protected $fillable = [
        'topbar', 'bottombar', 'topheader', 'bottomfooter',
        'popular_products', 'flash_deal', 'deal_of_the_day', 'best_sellers',
        'brands', 'top_big_trending', 'top_brand', // bool
        'status',
        'featured_banner_id',
        'page_id',
        'language_id',
    ];

    public function featuredBanner()
    {
        return $this->belongsTo(FeaturedBanner::class, 'featured_banner_id');
    }

    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
