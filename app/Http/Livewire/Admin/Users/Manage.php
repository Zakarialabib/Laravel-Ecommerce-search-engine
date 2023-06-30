<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;
use Illuminate\Contracts\View\View;
use App\Models\Subscription;

class Manage extends Component
{
    public $renewModal = false;

    public function renewModal($id)
    {
        $subscription = Subscription::find($id);

        $this->renewModal = true;
    }

    public function renew($id)
    {
    }

    public function updateSubscriptions($id)
    {
        $subscriptionIds = Subscription::find($id);
        $this->user->subscriptions()->sync($subscriptionIds);
        $this->alert('success', __('Subscription updated successfully!'));
    }

    public function removeSubscription($id)
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
