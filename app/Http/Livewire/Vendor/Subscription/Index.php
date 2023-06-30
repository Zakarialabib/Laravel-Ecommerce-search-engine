<?php

declare(strict_types=1);

namespace App\Http\Livewire\Vendor\Subscription;

use Livewire\Component;
use App\Models\UserSubscription;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $subscription;

    public function mount()
    {
        $this->subscription = UserSubscription::where('user_id', Auth::user()->id)->get();
        dd($this->subscription);
    }

    public function render()
    {
        return view('livewire.vendor.subscription.index')->layout('layouts.vendor');
    }
}
