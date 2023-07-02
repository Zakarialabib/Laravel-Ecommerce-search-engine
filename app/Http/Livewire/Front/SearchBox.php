<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\Product;
use App\Models\DeviceModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;

class SearchBox extends Component
{
    public $listeners = ['updatedSearch' => 'search'];

    public $search = null;

    public $results = [];

    public $searchBox = true;

    public function updatedSearch(): void
    {
        if (strlen($this->search) > 3) {
    
            $productResults = Product::active()
                ->where('name', 'like', '%'.$this->search.'%')
                ->orWhere('description', 'like', '%'.$this->search.'%')
                ->limit(5)
                ->get();
    
            $deviceModelResults = DeviceModel::active()
                ->where('name', 'like', '%'.$this->search.'%')
                ->limit(5)
                ->get();
    
            $this->results = new Collection($productResults->merge($deviceModelResults));
    
        } else {
            $this->results = new Collection([]);
        }
    }
    

    public function hideSearchResults(): void
    {
        $this->searchBox = false;
        $this->clearSearch();
    }

    public function clearSearch(): void
    {
        $this->search = '';
        $this->results = [];
    }

    public function render(): View|Factory
    {
        return view('livewire.front.search-box');
    }
}
