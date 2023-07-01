<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\Blog
 *
 * @property int $id
 * @property string $title
 * @property string $details
 * @property string|null $image
 * @property string $slug
 * @property int $status
 * @property int $featured
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property int|null $category_id
 * @property int|null $language_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \App\Models\BlogCategory|null $category
 * @property-read \App\Models\Language|null $language
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Blog active()
 * @method static \Illuminate\Database\Eloquent\Builder|Blog advancedFilter($data)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Blog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Blog query()
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereMetaDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereMetaTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Blog extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasAdvancedFilter;

    public const ATTRIBUTES = [
        'id',
        'title',
        'slug',
        'status',
        'featured',
        'category_id',
        'language_id',
    ];

    public $orderable = self::ATTRIBUTES;
    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'title',
        'details',
        'image',
        'slug',
        'status',
        'featured',
        'category_id',
        'meta_title',
        'meta_description',
        'language_id',
    ];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('blogs');
    }

    public function registerMediaConversions($media = null): void
    {
        $this->addMediaConversion('large')
            ->width(800)
            ->height(800)
            ->performOnCollections('blogs')
            ->format('webp');
    }

    /** Scope a query to only include active products. */
    public function scopeActive(\Illuminate\Database\Eloquent\Builder $query): void
    {
        $query->where('status', true);
    }
}
