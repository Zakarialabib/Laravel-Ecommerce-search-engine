<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ProductPrices extends Component
{
    use LivewireAlert;
    use WithPagination;

    public $listeners = ['updatedSearch' => 'search'];

    public $search = null;

    public $results;
    public $products;

    public $howMany = 5;

    public function loadMore(): void
    {
        $this->howMany += 5;
    }

    public function updatedSearch(): void
    {
        $searchTerm = $this->search;

        if (strlen($this->search) > 3) {
            $this->results = Product::active()
                ->where('name', 'like', '%'.$this->search.'%')
                ->take($this->howMany)
                ->get();
        } else {
            $this->results = '';
        }
    }

    public function clearSearch(): void
    {
        $this->search = '';
        $this->results = [];
    }

    public function render(): View|Factory
    {
        return view('livewire.front.product-prices');
    }
}
