<?php

declare(strict_types=1);

namespace App\Http\Livewire\Vendor;

use Livewire\Component;
use Illuminate\Contracts\View\View;

class Dashboard extends Component
{
    public function render(): View
    {
        return view('livewire.vendor.dashboard')
            ->extends('layouts.vendor');
    }
}
