<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Store;

class CheckApproved
{
    /** Handle an incoming request. */
    public function handle(Request $request, Closure $next): mixed
    {
        $user = auth()->user();

        if (!$user || !$user->status) {
            return redirect()->route('auth.approval');
        }

        $store = Store::where('user_id', $user->id)->first();

        if (!$store || !$store->status) {
            return redirect()->route('auth.approval');
        }

        return $next($request);
    }
}
