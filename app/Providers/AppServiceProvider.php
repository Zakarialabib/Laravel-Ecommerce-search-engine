<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Language;
use App\Models\Settings;
use App\Observers\SettingsObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }

        View::share('languages', $this->getLanguages());

        Settings::observe(SettingsObserver::class);

        // Model::shouldBeStrict(! $this->app->isProduction());
    }

    private function getLanguages(): void
    {
        if (! Schema::hasTable('languages')) {
            return;
        }

        return cache()->rememberForever('languages', function () {
            return Session::has('language')
                ? Language::pluck('name', 'code')->toArray()
                : Language::where('is_default', 1)->first();
        });
    }
}
