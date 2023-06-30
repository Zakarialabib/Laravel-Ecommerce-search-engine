<?php

declare(strict_types=1);

namespace App\Http\Livewire\Vendor\Account;

use App\Models\Store;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
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
    public $store_logo;
    public $banner_image;
    public $social_links;
    
    public $password;

    protected $listeners = [
        'submit',
    ];

    protected $rules = [
        'email'   => 'required|email',
        'name'    => 'required|string',
        'address' => 'nullable|max:255',
        'phone'   => 'required|numeric|max:1O',
        'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
        'city'    => 'nullable|string',
        'country' => 'nullable',
        'store_name' => 'required',
        'store_url' => 'required',
        'store_phone' => 'required',
        'store_address' => 'nullable',
        'logo' => 'nullable',
        'banner_image' => 'nullable',
        'social_links' => 'array',
    ];

    public function mount()
    {
        $this->user = User::with('store')->whereId(Auth::user()->id)->first();
        $this->name = $this->user->name;
        $this->address = $this->user->address;
        $this->phone = $this->user->phone;
        $this->city = $this->user->city;
        $this->country = $this->user->country;
        $this->email = $this->user->email;
        $this->password = $this->user->password;
        
        $store = Store::whereId($this->user->store_id)->first();

        $this->store_name = $store->name;
        $this->store_url = $store->url;
        $this->store_phone = $store->phone;
        $this->image = $store->location;
        $this->store_address = $store->location;
        $this->logo = $store->lofo;
        $this->banner_image = $store->banner_image;
        $this->social_links = $store->social_links ?? [];
        
    }

    public function save()
    {
        $this->validate();

        if ($this->password !== '') {
            $this->user->password = bcrypt($this->password);
        }

        $this->user->update();

        // store update 
        $this->user->store->name = $this->store_name;
        $this->user->store->url = $this->store_url;
        $this->user->store->phone = $this->store_phone;
        $this->user->store->location = $this->store_address;
        $this->user->store->logo = $this->logo;
        $this->user->store->banner_image = $this->banner_image;
        $this->user->store->social_links = json_encode($this->social_links);
        $this->user->store->update();

        $this->alert('success', 'Account updated successfully', [
            'position' =>  'top-end',
            'timer' =>  3000,
            'toast' =>  true,
            'text' =>  '',
            'confirmButtonText' =>  'Ok',
            'cancelButtonText' =>  'Cancel',
            'showCancelButton' =>  false,
            'showConfirmButton' =>  false,
        ]);
    }

    public function render()
    {
        return view('livewire.vendor.account.index')->extends('layouts.vendor');
    }
}
