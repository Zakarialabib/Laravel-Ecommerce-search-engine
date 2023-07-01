<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Users;

use App\Models\Subscription;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Manage extends Component
{
    public $renewModal = false;

    public function renewModal($id): void
    {
        $subscription = Subscription::find($id);

        $this->renewModal = true;
    }

    public function renew($id): void
    {
    }

    public function updateSubscriptions($id): void
    {
        $subscriptionIds = Subscription::find($id);
        $this->user->subscriptions()->sync($subscriptionIds);
        $this->alert('success', __('Subscription updated successfully!'));
    }

    public function removeSubscription($id): void
    {
        $user = User::find($userId);
        $user->subscriptions()->detach($subscriptionId);
        $this->subscriptions = $user->subscriptions()->get()->toArray();
        $this->alert('success', __('Subscription removed successfully!'));
    }

    public function render(): View
    {
        return view('livewire.admin.users.manage');
    }
}
