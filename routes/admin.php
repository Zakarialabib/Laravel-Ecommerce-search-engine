<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FeaturedBannerController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SmptController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Livewire\Admin\Users\Index as UserIndex;
use App\Http\Livewire\Admin\Blog\Index as BlogIndex;
use App\Http\Livewire\Admin\Service\Index as ServiceIndex;
use App\Http\Livewire\Admin\Categories\Index as CategoryIndex;
use App\Http\Livewire\Admin\DeviceModels\Index as DeviceModelIndex;
use App\Http\Livewire\Admin\Email\Index as EmailIndex;
use App\Http\Livewire\Admin\Menu\Index as MenuIndex;
use App\Http\Livewire\Admin\Language\Index as LanguageIndex;
use App\Http\Livewire\Admin\Language\EditTranslation;
use App\Http\Livewire\Admin\Backup\Index as BackupIndex;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'role:ADMIN', 'firewall.all']], function () {
    // change lang
    Route::get('/lang/{lang}', [DashboardController::class, 'changeLanguage'])->name('changelanguage');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/categories', CategoryIndex::class)->name('categories');
    Route::get('/subcategories', [CategoryController::class, 'subcategories'])->name('subcategories');
    Route::get('/brands', [BrandController::class, 'index'])->name('brands');
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::get('/device-models', DeviceModelIndex::class)->name('device-models');
    Route::get('/services', ServiceIndex::class)->name('services.index');

    Route::get('/blogs', BlogIndex::class)->name('blogs');
    Route::get('/blog/category', [BlogCategoryController::class, 'index'])->name('blogcategories');

    Route::get('users', UserIndex::class)->name('users');

   Route::get('/email-template', EmailIndex::class)->name('email-templates.index');
   Route::get('/menu-settings', MenuIndex::class)->name('menu-settings.index');

    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics');
   
    Route::get('/pages', [PageController::class, 'index'])->name('pages');
    Route::get('/page/settings', [PageController::class, 'settings'])->name('page.settings');
    Route::get('/sections', [SectionController::class, 'index'])->name('sections');
    Route::get('/sliders', [SliderController::class, 'index'])->name('sliders');
    Route::get('/featuredBanners', [FeaturedBannerController::class, 'index'])->name('featuredBanners');
     
    Route::get('/order-forms', [PageController::class, 'orderForms'])->name('orderforms');

    Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('setting.subscriptions');


    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    
    Route::get('/popupsettings', [SettingController::class, 'popupsettings'])->name('setting.popupsettings');
    Route::get('/redirects', [SettingController::class, 'redirects'])->name('setting.redirects');
    Route::get('/backup', BackupIndex::class)->name('setting.backup');
    Route::get('/report', [ReportController::class, 'index'])->name('report');

    Route::get('/notification', [NotificationController::class, 'index'])->name('notification');
    Route::get('/smpt', [SmptController::class, 'index'])->name('smpt');
    
    Route::get('/language', LanguageIndex::class)->name('language');
    Route::get('/translation/{code}', EditTranslation::class)->name('translation');

    Route::get('/roles', [RolesController::class, 'index'])->name('roles');
    Route::get('/permissions', [UsersController::class, 'permissions'])->name('permissions');
    Route::get('/currencies', [SettingController::class, 'currencies'])->name('currencies');
});
