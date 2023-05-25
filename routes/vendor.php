<?php

declare(strict_types=1);

use App\Http\Livewire\Vendor\Dashboard as VendorDashboard;
use App\Http\Controllers\Vendor\ProductController as VendorProducts;
use App\Http\Controllers\Vendor\AnalyticsController as VendorAnalytics;
use App\Http\Controllers\Vendor\AccountController as VendorAccount;
use App\Http\Controllers\Vendor\SubscriptionController as VendorSubscription;


/*
|--------------------------------------------------------------------------
| Vendor Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "vendor" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'vendor', 'as' => 'vendor.', 'middleware' => ['auth', 'role:VENDOR', 'firewall.all','approved']], function () {

    Route::get('/dashboard', VendorDashboard::class)->name('dashboard');
    Route::get('/products', [VendorProducts::class, 'index'])->name('products');
    Route::get('/analytics', [VendorAnalytics::class, 'index'])->name('analytics');
    Route::get('/account', [VendorAccount::class, 'index'])->name('account');
    Route::get('/subscription', [VendorSubscription::class, 'index'])->name('subscription');

});