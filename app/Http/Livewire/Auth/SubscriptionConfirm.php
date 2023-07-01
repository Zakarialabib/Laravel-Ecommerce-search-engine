<?php

declare(strict_types=1);

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Contracts\View\View;
use App\Models\UserSubscription;
use App\Models\SubscriptionOrder;
use App\Models\Subscription;

class SubscriptionConfirm extends Component
{
    public $selectedPlan;
    public $startsAt;
    public $endsAt;
    public $payment_method = 'bank';

    public function getSubscriptionsProperty()
    {
        return Subscription::query()->get();
    }

    public function selectPlan($planId)
    {
        $this->selectedPlan = Subscription::findOrFail($planId);
        $this->calculateDates();
    }

    public function confirmSubscription()
    {
        if ( ! auth()->check()) {
            return redirect()->route('login');
        }

        $subscriptionOrder = SubscriptionOrder::create([
            'user_id'         => auth()->user()->id,
            'subscription_id' => $this->selectedPlan->id,
            'amount'          => $this->selectedPlan->price,
            'payment_method'  => $this->payment_method,
            'payment_status'  => false,
            'payment_status'  => true,
        ]);

        UserSubscription::create([
            'user_id'         => auth()->user()->id,
            'subscription_id' => $this->selectedPlan->id,
            'order_id'        => $subscriptionOrder->id,
            'starts_at'       => $this->startsAt,
            'ends_at'         => $this->endsAt,
            'status'          => true,
        ]);

        return redirect()->route('vendor.dashboard');
    }

    private function calculateDates()
    {
        $startsAt = now();
        $endsAt = $startsAt->copy();

        switch ($this->selectedPlan->duration) {
            case '7':
                $endsAt->addDays(7);

                break;
            case '30':
                $endsAt->addDays(30);

                break;
            case '365':
                $endsAt->addDays(365);

                break;
        }

        $this->startsAt = $startsAt;
        $this->endsAt = $endsAt;
    }

    public function render(): View
    {
        return view('livewire.auth.subscription-confirm')->extends('layouts.app');
    }
}
