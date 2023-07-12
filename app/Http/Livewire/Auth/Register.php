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
use Illuminate\Support\Str;

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
    public $storeLocation;

    protected $rules =[
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required|numeric',
        'password' => 'required|min:8|same:passwordConfirmation',
        'city' => 'required',
        'country' => 'required',
        'storeName' => 'required|unique:stores,name',
        'storeUrl' => 'required|url|unique:stores,url',
        'storePhone' => 'required|numeric',
        'storeLocation' => 'required',
    ];

    protected $messages = [
        'name.required' => 'The name field is required.',
        'email.required' => 'The email field is required.',
        'email.email' => 'The email must be a valid email address.',
        'email.unique' => 'The email has already been taken.',
        'phone.required' => 'The phone field is required.',
        'phone.numeric' => 'The phone must be a number.',
        'password.required' => 'The password field is required.',
        'password.min' => 'The password must be at least 8 characters.',
        'password.same' => 'The password confirmation does not match.',
        'city.required' => 'The city field is required.',
        'country.required' => 'The country field is required.',
        'storeName.required' => 'The store name field is required.',
        'storeName.unique' => 'The store name has already been taken.',
        'storeUrl.required' => 'The store url field is required.',
        'storeUrl.url' => 'The store url must be a valid url.',
        'storeUrl.unique' => 'The store url has already been taken.',
        'storePhone.required' => 'The store phone field is required.',
        'storePhone.numeric' => 'The store phone must be a number.',
        'storeLocation.required' => 'The store location field is required.',
    ];

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
                'location'  => $this->storeLocation,
                'user_id'  => $user->id,
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
