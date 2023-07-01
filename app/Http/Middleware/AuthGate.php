<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;

class AuthGate
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $user = auth()->user();

        if ($user) {
            $roles = Role::with('permissions')->get();
            $permissionsArray = [];

            foreach ($roles as $role) {
                foreach ($role->permissions as $permissions) {
                    $permissionsArray[$permissions->name][] = $role->name;
                }
            }

            foreach ($permissionsArray as $name => $roles) {
                Gate::define($name, function ($user) use ($roles) {
                    return $user->hasAnyRole($roles);
                });
            }
        }

        return $next($request);
    }
}
