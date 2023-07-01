<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\FeaturedBanner
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string|null $image
 * @property string|null $label
 * @property string|null $link
 * @property string|null $embeded_video
 * @property int|null $language_id
 * @property int|null $product_id
 * @property int $featured
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \App\Models\Language|null $language
 * @property-read \App\Models\Product|null $product
 *
 * @method static \Illuminate\Database\Eloquent\Builder|FeaturedBanner advancedFilter($data)
 * @method static \Illuminate\Database\Eloquent\Builder|FeaturedBanner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FeaturedBanner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FeaturedBanner query()
 * @method static \Illuminate\Database\Eloquent\Builder|FeaturedBanner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FeaturedBanner whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FeaturedBanner whereEmbededVideo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FeaturedBanner whereFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FeaturedBanner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FeaturedBanner whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FeaturedBanner whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FeaturedBanner whereLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FeaturedBanner whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FeaturedBanner whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FeaturedBanner whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FeaturedBanner whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FeaturedBanner whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class FeaturedBanner extends Model
{
    use HasAdvancedFilter;

    public const StatusInactive = 0;

    public const StatusActive = 1;

    public $orderable = [
        'id', 'title', 'description', 'image', 'status', 'featured', 'language_id',
    ];

    protected $filterable = [
        'id', 'title', 'description', 'image', 'status', 'featured', 'language_id',
    ];

    protected $fillable = [
        'title', 'description', 'image', 'embeded_video', 'status', 'featured', 'link', 'language_id', 'product_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
