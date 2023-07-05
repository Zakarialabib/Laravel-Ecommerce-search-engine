<?php

declare(strict_types=1);

namespace App\Http\Livewire\Vendor\Account;

use App\Models\Store;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $user;
    public $name;
    public $phone;
    public $email;
    public $address;
    public $city;
    public $country;
    public $store_name;
    public $store_url;
    public $store_phone;
    public $store_address;
    public mixed $logo;
    public mixed $banner_image;
    public $social_links;

    public $password;

    protected $listeners = [
        'submit',
    ];

    protected $rules = [
        'email'         => 'required|email',
        'name'          => 'required|string',
        'address'       => 'nullable|max:255',
        'phone'         => 'required|numeric|max:1O',
        'password'      => 'required|min:8',
        'city'          => 'nullable|string',
        'country'       => 'nullable',
        'store_name'    => 'required',
        'store_url'     => 'required',
        'store_phone'   => 'required',
        'store_address' => 'nullable',
        'logo'          => 'nullable',
        'banner_image'  => 'nullable',
        'social_links'  => 'array',
    ];

    public function mount(): void
    {
        $this->user = User::whereId(Auth::user()->id)->first();
        $this->name = $this->user->name;
        $this->address = $this->user->address;
        $this->phone = $this->user->phone;
        $this->city = $this->user->city;
        $this->country = $this->user->country;
        $this->email = $this->user->email;
        $this->password = $this->user->password;

        $store = Store::where('user_id', $this->user->id)->first();

        $this->store_name = $store->name;
        $this->store_url = $store->url;
        $this->store_phone = $store->phone;
        $this->store_address = $store->location;
        $this->logo = $store->logo;
        $this->banner_image = $store->banner_image;
        $this->social_links = $store->social_links ?? [];
    }

    public function store(): void
    {
        $this->validate();

        if ($this->password !== '') {
            $this->user->password = bcrypt($this->password);
        }

        $this->user->update();

        // store update
        $store = Store::where('user_id', $this->user->id)->first();
        $store->name = $this->store_name;
        $store->url = $this->store_url;
        $store->phone = $this->store_phone;
        $store->location = $this->store_address;

        if ($store->logo) {
            $image_path = public_path('images/store/'.$store->logo);

            if (file_exists($image_path)) {
                unlink($image_path);
            }

            $imageName = 'logo-'.$this->store_name.'jpg';
            $this->logo->storeAs('images/store/', $imageName);
            $store->logo = $imageName;
        }

        if ($store->banner_image) {
            $image_path = public_path('images/store/'.$store->banner_image);

            if (file_exists($image_path)) {
                unlink($image_path);
            }

            $imageName = 'banner-'.$this->store_name.'jpg';
            $this->banner_image->storeAs('images/store/', $imageName);
            $store->banner_image = $imageName;
        }
        $store->social_links = $this->social_links;

        $this->alert('success', 'Account updated successfully', [
            'position'          => 'top-end',
            'timer'             => 3000,
            'toast'             => true,
            'text'              => '',
            'confirmButtonText' => 'Ok',
            'cancelButtonText'  => 'Cancel',
            'showCancelButton'  => false,
            'showConfirmButton' => false,
        ]);
    }

    public function render()
    {
        return view('livewire.vendor.account.index')->extends('layouts.vendor');
    }
}
