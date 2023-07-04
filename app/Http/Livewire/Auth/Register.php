<?php

declare(strict_types=1);

namespace App\Http\Livewire\Auth;

use App\Enums\Status;
use App\Models\Store;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Register extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $passwordConfirmation = '';
    public $phone;
    public $city; // Set the default city to 'Casablanca'
    public $country; // Set
    public $isStoreOwner = false;

    // Properties for store owners only
    public $storeName;
    public $storeUrl;
    public $storePhone;

    protected $listeners = ['storeOwnerChanged'];

    public function storeOwnerChanged(): void
    {
        $this->isStoreOwner = ! $this->isStoreOwner;
        $this->emit('storeOwnerChanged', $this->isStoreOwner);
    }

    public function mount(): void
    {
        $this->city = 'Casablanca';
        $this->country = 'Morocco';
    }

    public function register()
    {
        $this->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'phone'    => 'required|numeric',
            'password' => 'required|min:8|same:passwordConfirmation',
        ]);

        $user = User::create([
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => Hash::make($this->password),
            'phone'    => $this->phone,
            'city'     => $this->city,
            'country'  => $this->country,
            'status'   => Status::INACTIVE, // Set status to inactive by default
        ]);

        $roleName = $this->isStoreOwner ? 'vendor' : 'client';

        $role = Role::where('name', $roleName)->first();

        $user->assignRole($role);

        if ($this->isStoreOwner) {
            $store = new Store([
                'name'   => $this->storeName,
                'url'    => $this->storeUrl,
                'phone'  => $this->storePhone,
                'slug'   => Str::slug($this->storeName),
                'status' => Status::INACTIVE, // Set status to inactive by default
            ]);

            $user->store()->save($store);

            $user->store_id = $store->id;
            $user->save();
        }

        event(new Registered($user));

        Auth::login($user, true);

        switch (true) {
            case $user->hasRole('admin'):
                return redirect()->intended(RouteServiceProvider::ADMIN_HOME);

                break;
            case $user->hasRole('vendor'):
                return redirect()->route('subscription-confirm');

                break;
            default:
                return redirect()->intended(RouteServiceProvider::CLIENT_HOME);

                break;
        }
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
