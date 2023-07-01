<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;

class CheckApproved
{
    /**
     * Handle an incoming request.
     */
    public function handle(\Illuminate\Http\Request $request, Closure $next): mixed
    {
        if (! auth()->user()->status) {
            return redirect()->route('auth.approval');
        }

        return $next($request);
    }
}
