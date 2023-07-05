<?php

declare(strict_types=1);

namespace App\Http\Livewire\Vendor\Subscription;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $userSubscription;

    public function mount(): void
    {
        $user = Auth::user();
        $this->userSubscription = $user->subscription->first();
    }

    public function render()
    {
        return view('livewire.vendor.subscription.index')->layout('layouts.vendor');
    }
}
