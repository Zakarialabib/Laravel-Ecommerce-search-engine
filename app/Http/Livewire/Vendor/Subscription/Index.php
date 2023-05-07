<?php

namespace App\Http\Livewire\Vendor\Subscription;

use App\Models\Subscription;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Livewire\WithConfirmation;
use App\Http\Livewire\WithSorting;

class Index extends Component
{
    public function render()
    {
        return view('livewire.vendor.subscription.index');
    }
}
