<?php

namespace App\Http\Livewire\Vendor\Account;

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Livewire\WithSorting;

class Index extends Component
{
    public $user;
    public $name;
    public $phone;
    public $email;
    public $address;
    public $city;
    public $country;

    public string $password = '';

    protected $listeners = [
        'submit',
    ];

    protected $rules = [
        'email'      => 'required|email',
        'name'       => 'required|string',
        'address'    => 'nullable|max:255',
        'phone'      => 'required|numeric|max:1O',
        'city'       => 'nullable|string',
        'country'    => 'nullable',
    ];

    public function mount(User $user)
    {
        $user = User::find(Auth::user()->id);
        $this->name = $user->name;
        $this->address = $user->address;
        $this->phone = $user->phone;
        $this->city = $user->city;
        $this->country = $user->country;
        $this->email = $user->email;
        $this->password = $user->password;
    }

    public function save()
    {
        $this->user = User::find(Auth::user()->id);

        $this->validate();

        if ($this->password !== '') {
            $this->user->password = bcrypt($this->password);
        }

        $this->user->update();
    }

    public function render()
    {
        return view('livewire.vendor.account.index');
    }
}
