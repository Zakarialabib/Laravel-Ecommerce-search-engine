<?php

declare(strict_types=1);

namespace App;

use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Page;
use App\Models\Currency;
use App\Models\Settings;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class Helpers
{
    /** Fetch Cached settings from database */
    public static function settings(mixed $key): mixed
    {
        return Cache::rememberForever('settings', function () {
            return Settings::pluck('value', 'key');
        })->get($key);
    }

    public static function getActiveCategories()
    {
        return Category::active()
            ->select('id', 'name')
            ->get();
    }

    public static function getActiveBrands()
    {
        return Brand::active()
            ->select('id', 'name', 'slug')
            ->get();
    }

    public static function getActivePages()
    {
        return Page::select('id', 'slug', 'title')
            ->inRandomOrder()
            ->take(5)
            ->get();
    }

    public static function getActiveBlogs()
    {
        return Blog::active()
            ->select(['id', 'title', 'slug','image','description','created_at'])
            ->inRandomOrder()
            ->take(5)
            ->get();
    }

    public static function getBrands()
    {
        return Brand::select('id', 'name', 'slug')
            ->get();
    }

    public static function categoryName($category_id)
    {
        return Category::find($category_id)->name;
    }

    public static function subcategoryName($subcategory_id)
    {
        return Subcategory::find($subcategory_id)->name;
    }

    public static function brandName($brand_id)
    {
        return Brand::find($brand_id)->name;
    }

    // make a vendor slug for links route
    public static function vendorSlug($id)
    {
        return Store::find($id)->slug;
    }

    public static function productLink(mixed $product): ?string
    {
        if ($product) {
            return route('front.product', $product->slug);
        }

        return null;
    }

      /**
     * Uploads an image from a URL and returns the file name.
     *
     * @param string $image_url The URL of the image to upload.
     * @param string $productName The name of the product.
     * @param int $size The size of the square to resize the image to.
     * @param string $folderName The name of the folder to store the image (either 'products' or 'device-models').
     *
     * @return string|null The name of the uploaded file, or null if the upload failed.
     */
    public static function uploadImage(string $image_url, string $productName, string $folderName, int $size = 800): ?string
    {
        $response = Http::get($image_url);

        if ($response->failed()) {
            return null;
        }

        $image_content = $response->body();

        // Generate a unique file name
        $name = Str::slug($productName).'-'.sprintf('%02d', 0).'.jpg';

        $img = Image::make($image_content)->encode('webp', 85);

        // we need to resize image, otherwise it will be cropped
        if ($img->width() > $size) {
            $img->resize($size, null, function ($constraint): void {
                $constraint->aspectRatio();
            });
        }

        if ($img->height() > $size) {
            $img->resize(null, $size, function ($constraint): void {
                $constraint->aspectRatio();
            });
        }

        $img->resizeCanvas($size, $size, 'center', false, '#ffffff');

        $img->stream();

        Storage::disk('local_files')->put($folderName . '/' . $name, $img, 'public');

        return $name;
    }

    /** @return array<string>|null */
    public static function uploadGallery(mixed $gallery): ?array
    {
        // Path cannot be empty
        if (empty($gallery)) {
            return null;
        }

        $gallery = explode(',', $gallery);

        return array_map(function ($image) {
            $image = file_get_contents($image);
            $name = Str::random(10).'.jpg';
            $path = public_path().'/images/products/'.$name;
            file_put_contents($path, $image);

            return $name;
        }, $gallery);
    }

    public static function createCategory(mixed $category): mixed
    {
        // Make sure $category is a string
        $category = implode('', $category);

        $slug = Str::slug($category, '-');

        return Category::create([
            'name' => $category,
            'slug' => $slug,
        ])->id;
    }

    /** @param mixed $subcategory */
    public static function createSubcategories($subcategories, mixed $category): mixed
    {
        $subcategoryIds = [];

        foreach (explode(',', $subcategories) as $subcategory) {
            $subcategoryModel = Subcategory::create([
                'name'        => trim($subcategory),
                'slug'        => Str::slug($subcategory, '-'),
                'category_id' => Category::where('name', $category)->first()->id,
                'language'    => '3',
            ]);
            $subcategoryIds[] = $subcategoryModel->id;
        }

        return $subcategoryIds;
    }

    public static function createBrand(mixed $brand): mixed
    {
        // Make sure $brand is a string
        $brand = implode('', $brand);

        return Brand::create([
            'name' => $brand,
            'slug' => Str::slug($brand, '-'),
        ])->id;
    }

    public static function format_currency(mixed $value, bool $format = true): mixed
    {
        if ( ! $format) {
            return $value;
        }

        $currency = Currency::where('is_default', 1)->first();
        $position = $currency->position;
        $symbol = $currency->symbol;

        return $position === 'prefix'
            ? $symbol.number_format((float) $value, 2, '.', ',')
            : number_format((float) $value, 2, '.', ',').$symbol;
    }

    public static function handleUpload($image, $width, $height, $productName)
    {
        $imageName = Str::slug($productName).'-'.Str::random(5).'.'.$image->extension();

        $img = Image::make($image->getRealPath())->encode('webp', 85);

        // we need to resize image, otherwise it will be cropped
        if ($img->width() > $width) {
            $img->resize($width, null, function ($constraint): void {
                $constraint->aspectRatio();
            });
        }

        if ($img->height() > $height) {
            $img->resize(null, $height, function ($constraint): void {
                $constraint->aspectRatio();
            });
        }

        $watermark = Image::make(public_path('images/logo.png'));
        $watermark->opacity(25);
        $watermarkWidth = intval($width / 5);
        $watermarkHeight = intval($watermarkWidth * $watermark->height() / $watermark->width());
        $img->insert($watermark, 'bottom-left', 20, 20)->resizeCanvas($width, $height, 'center', false, '#ffffff');

        $img->stream();

        Storage::disk('local_files')->put('products/'.$imageName, $img, 'public');

        return $imageName;
    }

    
    public static function flagImageUrl($language_code)
    {
        return asset("images/flags/{$language_code}.png");
    }
}
