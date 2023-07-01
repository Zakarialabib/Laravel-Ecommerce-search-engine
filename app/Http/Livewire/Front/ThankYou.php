<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\SubscriptionOrder;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ThankYou extends Component
{
    //  show subscription details on thank you page

    public $subscription;

    public function mount($subscription): void
    {
        $this->subscription = SubscriptionOrder::findOrFail($subscription->id);
    }

    public function render(): View|Factory
    {
        return view('livewire.front.thank-you');
    }
}
