<?php

namespace App\Http\Livewire\Front;

use App\Models\Brand;
use App\Models\Category;
use App\Models\DeviceModel;
use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class BrandPage extends Component
{
    use WithPagination;

    public $listeners = [
        'load-more-products' => 'loadMoreProducts',
        'load-more-device-models' => 'loadMoreDeviceModels',
    ];

    public $perPage = 25;

    public $paginationOptions = [25, 50, 100];

    public $sortingOptions = [];

    public Brand $brand;

    public string $sorting = '';
    
    public $selectedCategory;

    public function mount(Brand $brand): void
    {
        $this->brand = $brand;
        
        $this->sortingOptions = [
            'name-asc'   => __('Order Alphabetic, A-Z'),
            'name-desc'  => __('Order Alphabetic, Z-A'),
            'price-asc'  => __('Price, low to high'),
            'price-desc' => __('Price, high to low'),
            'date-asc'   => __('Date, new to old'),
            'date-desc'  => __('Date, old to new'),
        ];
    }

    public function loadMoreProducts(): void
    {
        $this->perPage += 25;
        $this->loadProducts();
    }

    public function loadMoreDeviceModels(): void
    {
        $this->perPage += 25;
        $this->loadDeviceModels();
    }

    public function render(): View|Factory
    {
        $categories = Category::select('id', 'name')->get();
        $products = $this->getSortedModels(Product::class);
        $deviceModels = $this->getSortedModels(DeviceModel::class);

        return view('livewire.front.brand-page', [
            'categories' => $categories,
            'products' => $products,
            'deviceModels' => $deviceModels,
        ]);
    }

    private function getSortedModels(string $modelClass)
    {
        $query = $modelClass::active()
            ->where('brand_id', $this->brand->id)
            ->when($this->selectedCategory, function ($query) {
                $query->where('category_id', $this->selectedCategory);
            });

        if ($this->sorting === 'name-asc') {
            $query->orderBy('name', 'asc');
        } elseif ($this->sorting === 'name-desc') {
            $query->orderBy('name', 'desc');
        } elseif ($this->sorting === 'price-asc') {
            $query->orderBy('price', 'asc');
        } elseif ($this->sorting === 'price-desc') {
            $query->orderBy('price', 'desc');
        } elseif ($this->sorting === 'date-asc') {
            $query->orderBy('created_at', 'asc');
        } elseif ($this->sorting === 'date-desc') {
            $query->orderBy('created_at', 'desc');
        }

        return $query->paginate($this->perPage);
    }
}