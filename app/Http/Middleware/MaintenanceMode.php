<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\Settings;
use Closure;

class MaintenanceMode
{
    public function handle($request, Closure $next)
    {
        $settings = Settings::find(1);

        if ($settings->site_maintenance_status === true) {
            return redirect()->route('front-maintenance');
        }

        return $next($request);
    }
}
