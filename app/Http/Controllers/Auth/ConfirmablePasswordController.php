<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ConfirmablePasswordController extends Controller
{
    /** Show the confirm password view. */
    public function show(): \Illuminate\View\View
    {
        return view('auth.confirm-password');
    }

    /** Confirm the user's password. */
    public function store(Request $request): mixed
    {
        if ( ! Auth::guard('web')->validate([
            'email'    => $request->user()->email,
            'password' => $request->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        $request->session()->put('auth.password_confirmed_at', time());

        if (Auth::user()->role('admin')) {
            return redirect()->intended(RouteServiceProvider::ADMIN_HOME);
        }

        if (Auth::user()->role('vendor')) {
            return redirect()->intended(RouteServiceProvider::VENDOR_HOME);
        }

        if (Auth::user()->role('client')) {
            return redirect()->intended(RouteServiceProvider::CLIENT_HOME);
        }

        return redirect('/');
    }
}
