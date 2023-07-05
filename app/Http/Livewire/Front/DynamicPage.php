<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Page;

class DynamicPage extends Component
{
    public $page;

    public function mount($slug): void
    {
        $this->page = Page::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.front.dynamic-page')->extends('layouts.app');
    }
}
