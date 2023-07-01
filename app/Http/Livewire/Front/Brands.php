<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Http\Livewire\WithSorting;
use App\Models\Brand;
use App\Models\DeviceModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Brands extends Component
{
    use WithPagination;
    use WithSorting;

    public $listeners = [
        'load-more' => 'loadMore',
    ];

    public int $perPage;

    public array $paginationOptions;

    public $brand_id;

    public $sorting;

    public $sortingOptions;

    public $selectedFilters = [];

    protected $queryString = [
        'brand_id' => ['except' => '', 'as' => 'b'],
        'sorting'  => ['except' => '', 'as' => 'filters'],
    ];

    public function updatingPerPage(): void
    {
        $this->resetPage();
    }

    public function mount(): void
    {
        $this->sortingOptions = [
            'name-asc'   => __('Order Alphabetic, A-Z'),
            'name-desc'  => __('Order Alphabetic, Z-A'),
            'price-asc'  => __('Price, low to high'),
            'price-desc' => __('Price, high to low'),
            'date-asc'   => __('Date, new to old'),
            'date-desc'  => __('Date, old to new'),
        ];
        $this->perPage = 25;
        $this->paginationOptions = [25, 50, 100];
    }

    public function loadMore(): void
    {
        $this->perPage += 25;
    }

    public function render(): View|Factory
    {
        $query = DeviceModel::active()
            ->when($this->brand_id, function ($query) {
                return $query->where('brand_id', $this->brand_id);
            });

        if ($this->sorting === 'name') {
            $query->orderBy('name', 'asc');
        } elseif ($this->sorting === 'name-desc') {
            $query->orderBy('name', 'desc');
        } elseif ($this->sorting === 'price') {
            $query->orderBy('price', 'asc');
        } elseif ($this->sorting === 'price-desc') {
            $query->orderBy('price', 'desc');
        } elseif ($this->sorting === 'date') {
            $query->orderBy('created_at', 'asc');
        } elseif ($this->sorting === 'date-desc') {
            $query->orderBy('created_at', 'desc');
        }

        $products = $query->paginate($this->perPage);

        $this->emit('deviceModalLoaded', $products->count());

        return view('livewire.front.brands', compact('products'));
    }

    public function getBrandsProperty()
    {
        return Brand::select('id', 'name', 'image', 'featured_image')->active()->get();
    }
}
