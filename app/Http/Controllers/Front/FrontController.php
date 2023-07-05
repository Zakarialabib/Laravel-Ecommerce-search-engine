<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Throwable;

class FrontController extends Controller
{
    public function categoryPage($slug)
    {
        $category = Category::where('slug', $slug)->first() ?? abort(404);

        return view('front.category-page', compact('category'));
    }

    public function subcategories()
    {
        return view('front.subcategories');
    }

    public function SubcategoryPage($slug)
    {
        $subcategory = Subcategory::where('slug', $slug)->first() ?? abort(404);

        return view('front.subcategory-page', compact('subcategory'));
    }

    public function contact()
    {
        return view('front.contact');
    }


    public function redirect($url)
    {
        // return view('front.redirect', compact('url'));
        return redirect()->away($url);
    }

    public function myaccount()
    {
        return view('front.user-account');
    }

    public function generateSitemaps()
    {
        try {
            Artisan::call('generate:sitemap');

            Log::info('Sitemap generated successfully!');

            return back();
        } catch (Throwable $th) {
            Log::info('Sitemap generation failed!', $th->getMessage());

            return back();
        }
    }
}
