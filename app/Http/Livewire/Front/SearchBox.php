<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\Product;
use App\Models\DeviceModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class SearchBox extends Component
{
    public $query = '';
    public $results = [];
    public $loading = false;
    public $perPage = 5; // Number of results to show initially
    public $loadMore = false;

    public function updatedQuery()
    {
        $this->search();
    }

    public function search()
    {
        if (empty($this->query)) {
            $this->results = []; // Reset the results array
            return;
        }
    
        // Fetch products and device models based on the search query
        $products = Product::with('store')->where('name', 'like', '%' . $this->query . '%')->limit($this->perPage)->get();
        $deviceModels = DeviceModel::where('name', 'like', '%' . $this->query . '%')->limit($this->perPage)->get();
    
        // Combine products and device models in the results array
        $this->results = [
            'products' => $products,
            'deviceModels' => $deviceModels,
        ];
    }
    

    public function loadMore()
    {
        $this->perPage += 5; // Increase the number of results to show
        $this->loadMore = true; // Set the flag to indicate that load more has been clicked
        $this->search(); // Perform the search again to get more results
    }

    public function clear()
    {
        $this->query = '';
        $this->results = [];
        $this->perPage = 5;
        $this->loadMore = false;
    }

    public function render(): View|Factory
    {
        return view('livewire.front.search-box');
    }
}
