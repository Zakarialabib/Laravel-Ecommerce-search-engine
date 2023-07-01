<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Subscription;

use App\Models\Subscription;
use Livewire\Component;

class Edit extends Component
{
    public Subscription $subscription;

    protected $listeners = [
        'submit',
    ];

    public function mount(Subscription $subscription): void
    {
        $this->subscription = $subscription;
    }

    public function render()
    {
        return view('livewire.admin.subscription.create');
    }

    public function submit(): void
    {
        $this->validate();

        $this->subscription->save();

        $this->alert('success', __('Subscription updated successfully!'));
    }

    protected function rules(): array
    {
        return [
            'subscription.name' => [
                'string',
                'required',
            ],
            'subscription.details' => [
                'string',
                'required',
            ],
        ];
    }
}
