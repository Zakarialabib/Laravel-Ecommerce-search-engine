<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckApproved
{
    /** Handle an incoming request. */
    public function handle(Request $request, Closure $next): mixed
    {
        if ( ! auth()->user()->store ) {
            return redirect()->route('auth.approval');
        }

        return $next($request);
    }
}
