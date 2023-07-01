<?php

declare(strict_types=1);

namespace App\Http\Livewire\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public string $email = '';

    public string $password = '';

    public bool $remember_me = false;

    protected array $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function authenticate()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember_me)) {
            $user = User::where(['email' => $this->email])->first();

            auth()->login($user, $this->remember_me);

            switch (true) {
                case $user->hasRole('admin'):
                    $homePage = RouteServiceProvider::ADMIN_HOME;

                    break;
                case $user->hasRole('vendor'):
                    $homePage = RouteServiceProvider::VENDOR_HOME;

                    break;
                default:
                    $homePage = RouteServiceProvider::CLIENT_HOME;

                    break;
            }

            return redirect()->intended($homePage);
        }
        $this->addError('email', __('These credentials do not match our records'));
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
