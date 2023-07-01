<?php

declare(strict_types=1);

namespace App\Http\Livewire\Vendor;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Dashboard extends Component
{
    public function render(): View
    {
        return view('livewire.vendor.dashboard')
            ->extends('layouts.vendor');
    }
}
