<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Status;
use App\Support\HasAdvancedFilter;
use App\Trait\GetModelByUuid;
use App\Trait\UuidGenerator;
use Gloudemans\Shoppingcart\CanBeBought;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string $description
 * @property string $image
 * @property string|null $gallery
 * @property string $code
 * @property string $slug
 * @property int $stock_status
 * @property Status $status
 * @property int|null $category_id
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subcategory> $subcategories
 * @property array|null $options
 * @property string|null $url
 * @property int|null $brand_id
 * @property int|null $price_id
 * @property int|null $user_id
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property string|null $meta_keywords
 * @property int $featured
 * @property int $hot
 * @property int $best
 * @property int $top
 * @property int $latest
 * @property int $big
 * @property int $trending
 * @property int $sale
 * @property int $is_discount
 * @property string|null $condition
 * @property string|null $discount_date
 * @property string|null $embeded_video
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \App\Models\Brand|null $brand
 * @property-read \App\Models\Category|null $category
 * @property-read \App\Models\VendorHighlighted|null $highlightedByVendor
 * @property-read \App\Models\Price|null $price
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Review> $reviews
 * @property-read int|null $reviews_count
 * @property-read \App\Models\Store|null $store
 * @property-read int|null $subcategories_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Product active()
 * @method static \Illuminate\Database\Eloquent\Builder|Product advancedFilter($data)
 * @method static \Database\Factories\ProductFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBig($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCondition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDiscountDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereEmbededVideo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereGallery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereHot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereIsDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereLatest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMetaTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePriceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStockStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSubcategories($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereTop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereTrending($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUuid($value)
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subcategory> $subcategories
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Review> $reviews
 *
 * @mixin \Eloquent
 */
class Product extends Model implements Buyable
{
    use CanBeBought;
    use HasAdvancedFilter;
    use HasFactory;
    use GetModelByUuid;
    use UuidGenerator;

    public const StatusInActive = 0;

    public const StatusActive = 1;

    public $orderable = [
        'id',
        'name',
        'code',
        'category_id',
        'brand_id',
        'status',
    ];

    public $filterable = [
        'id',
        'name',
        'code',
        'category_id',
        'brand_id',
        'status',
    ];

    protected $fillable = [
        'name',
        'description',
        'slug',
        'code',
        'image',
        'gallery',
        'embeded_video',
        'category_id',
        'subcategories',
        'user_id',
        'url',
        'brand_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
        'featured',
        'hot',
        'best',
        'top',
        'latest',
        'big',
        'trending',
        'sale',
        'price_id',
        'is_discount',
        'discount_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'subcategories' => 'array',
        'status'        => Status::class,
        'options'       => 'array',
    ];

    public function setNameAttribute($value): void
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function price()
    {
        return $this->belongsTo(Price::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'user_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function subcategories(): BelongsToMany
    {
        return $this->belongsToMany(Subcategory::class);
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function highlightedByVendor()
    {
        return $this->hasOne(VendorHighlighted::class);
    }

    /** Scope a query to only include active products. */
    public function scopeActive(\Illuminate\Database\Eloquent\Builder $query): void
    {
        $query->where('status', 1);
    }
}
