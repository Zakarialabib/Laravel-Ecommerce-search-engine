<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use Livewire\Component;
use Illuminate\Contracts\View\View;
use App\Models\Service;
use App\Models\Subscription;

class Services extends Component
{
    public function getServicesProperty()
    {
        return Service::query()->get();
    }

    public function getSubscriptionsProperty()
    {
        return Subscription::query()->get();
    }

    public function render(): View
    {
        return view('livewire.front.services')->extends('layouts.app');
    }
}
