<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Enums\Status;
use App\Models\Language;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;

class Locale
{
    /** Handle an incoming request. */
    public function handle(\Illuminate\Http\Request $request, Closure $next): mixed
    {
        // Set config translatable.locales
        if (Schema::hasTable('languages')) {
            $languages = Language::query()
                ->where('status', Status::ACTIVE)
                ->get()->toArray();

            $language_default = Language::query()
                ->where('is_default', Language::IS_DEFAULT)
                ->first('code');
        }

        $language_code = Session::get('language_code');

        if ($language_code) {
            App::setLocale($language_code);
        } else {
            if ($language_default) {
                App::setLocale($language_default['code']);
            } else {
                App::setLocale(config('app.locale'));
            }
        }

        return $next($request);
    }
}
