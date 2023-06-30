<?php

declare(strict_types=1);

use App\Http\Livewire\Vendor\Dashboard as VendorDashboard;
use App\Http\Livewire\Vendor\Product\Index as VendorProducts;
use App\Http\Livewire\Vendor\Settings\Index as VendorSettings;
use App\Http\Livewire\Vendor\Account\Index as VendorAccount;
use App\Http\Livewire\Vendor\Subscription\Index as VendorSubscription;

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

Route::group(['prefix' => 'vendor', 'as' => 'vendor.', 'middleware' => ['auth', 'role:vendor', 'firewall.all', 'approved']], function () {
    Route::get('/dashboard', VendorDashboard::class)->name('dashboard');
    Route::get('/products', VendorProducts::class)->name('products');
    Route::get('/settings', VendorSettings::class)->name('settings');
    Route::get('/account', VendorAccount::class)->name('account');
    Route::get('/subscription', VendorSubscription::class)->name('subscription');
});
