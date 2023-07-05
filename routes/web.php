<?php

declare(strict_types=1);

use App\Http\Controllers\ErrorController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\UploadController;
use App\Http\Livewire\Front\DeviceShow;
use App\Http\Livewire\Front\Services;
use App\Http\Livewire\Front\DynamicPage;
use App\Http\Livewire\Front\Brands as BrandsIndex;
use App\Http\Livewire\Front\BrandPage as BrandShow;
use App\Http\Livewire\Front\Market as MarketIndex;
use App\Http\Livewire\Front\Index as FrontIndex;
use App\Http\Livewire\Front\VendorStore as VendorStoreIndex;
use App\Http\Livewire\Front\Categories as CategoryIndex;
use App\Http\Livewire\Front\Catalog as CatalogIndex;
use App\Http\Livewire\Front\Blogs as BlogIndex;
use App\Http\Livewire\Front\ShowBlog as BlogShow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/vendor.php';

Route::group(['middleware' => 'firewall.all'], function () {
    Route::get('/', FrontIndex::class)->name('front.index');
    Route::get('/catalog', CatalogIndex::class)->name('front.catalog');
    Route::get('/categories', CategoryIndex::class)->name('front.categories');
    Route::get('/categorie/{slug}', [FrontController::class, 'categoryPage'])->name('front.categoryPage');
    Route::get('/categories/{slug}', [FrontController::class, 'subcategoryPage'])->name('front.subcategoryPage');
    Route::get('/marques', BrandsIndex::class)->name('front.brands');
    Route::get('/marque/{slug}', BrandShow::class)->name('front.brandPage');
    Route::get('/catalog/{slug}', [FrontController::class, 'productShow'])->name('front.product');
    Route::get('/device-model/{slug}', DeviceShow::class)->name('front.deviceshow');
    Route::get('/vendeurs', MarketIndex::class)->name('front.vendors');
    Route::get('/contact', [FrontController::class, 'contact'])->name('front.contact');
    Route::get('/a-propos', [FrontController::class, 'about'])->name('front.about');
    Route::get('/blog', BlogIndex::class)->name('front.blogs');
    Route::get('/blog/{slug}', BlogShow::class)->name('front.blogPage');
    Route::get('/page/{slug}', DynamicPage::class)->name('front.dynamicPage');
    Route::get('/generate-sitemap', [FrontController::class, 'generateSitemaps'])->name('generate-sitemaps');
    Route::get('/redirect/{url}', [FrontController::class, 'redirect'])->name('redirect');
    Route::get('/services', Services::class)->name('front.services');
    Route::get('/approval', function () {
        return view('auth.approval');
    })->name('auth.approval');

    Route::middleware('auth')->group(function () {
        Route::get('/mon-compte', [FrontController::class, 'myaccount'])->name('front.myaccount');
        Route::get('/store/{slug}', VendorStoreIndex::class)->name('front.store-show');
    });

    Route::post('/uploads', [UploadController::class, 'upload'])->name('upload');
});

Route::get('/clear-cache', function () {
    Artisan::call('optimize:clear');
    Artisan::call('optimize');

    return 'Cache is cleared';
});

Route::fallback(function (Request $request) {
    return app()->make(ErrorController::class)->notFound($request);
});
