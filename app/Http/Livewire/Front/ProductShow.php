<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ProductShow extends Component
{
    use LivewireAlert;

    public $product;

    public $relatedProducts;

    public $brand;

    public $category;

    public $product_id;

    public $product_name;

    public $product_price;

    public $product_qty;

    public $brand_products;

    public $listeners = [
    ];

    public function mount($slug): void
    {
        $this->product = Product::where('slug', $slug)->firstOrFail();

        $this->brand_products = Product::active()->where('brand_id', $this->product->brand_id)->take(3)->get();
        $this->relatedProducts = Product::active()
            ->inRandomOrder()
            ->limit(4)
            ->get();

        $this->brand = Brand::where('id', $this->product->brand_id)->first();
        $this->category = Category::where('id', $this->product->category_id)->first();
    }

    public function render(): View|Factory
    {
        return view('livewire.front.product-show')->layout('layouts.app');
    }
}
