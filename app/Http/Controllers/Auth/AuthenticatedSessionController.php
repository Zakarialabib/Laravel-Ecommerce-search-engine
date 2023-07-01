<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /** Display the login view. */
    public function create(): \Illuminate\View\View
    {
        return view('auth.login');
    }

    /** Handle an incoming authentication request. */
    public function store(LoginRequest $request): \Illuminate\Http\RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        if (Auth::user()->isAdmin()) {
            return redirect()->intended(RouteServiceProvider::ADMIN_HOME);
        }

        if (Auth::user()->isVendor()) {
            return redirect()->intended(RouteServiceProvider::VENDOR_HOME);
        }

        if (Auth::user()->isClient()) {
            return redirect()->intended(RouteServiceProvider::CLIENT_HOME);
        }

        return redirect('/');
    }

    /** Destroy an authenticated session. */
    public function destroy(Request $request): \Illuminate\Http\RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
