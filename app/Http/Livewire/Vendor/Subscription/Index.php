<?php

declare(strict_types=1);

namespace App\Http\Livewire\Vendor\Subscription;

use App\Models\UserSubscription;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $subscription;

    public function mount(): void
    {
        $this->subscription = UserSubscription::where('user_id', Auth::user()->id)->get();
    }

    public function render()
    {
        return view('livewire.vendor.subscription.index')->layout('layouts.vendor');
    }
}
