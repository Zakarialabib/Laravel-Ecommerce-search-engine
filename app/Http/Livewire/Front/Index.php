<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\Brand;
use App\Models\FeaturedBanner;
use App\Models\Product;
use App\Models\Section;
use App\Models\Slider;
use App\Models\Subcategory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;

class Index extends Component
{
    public function getSubcategoriesProperty(): Collection
    {
        return Subcategory::inRandomOrder()->limit(4)->get();
    }

    public function getFeaturedProductsProperty(): Collection
    {
        return Product::where('featured', 1)
            ->active()
            ->inRandomOrder()
            ->limit(4)
            ->get();
    }

    public function getBestOffersProperty(): Collection
    {
        return Product::where('best', 1)
            ->active()
            ->inRandomOrder()
            ->limit(4)
            ->get();
    }

    public function getHotProductsProperty(): Collection
    {
        return Product::where('hot', 1)
            ->active()
            ->inRandomOrder()
            ->limit(4)
            ->get();
    }

    public function getBrandsProperty(): Collection
    {
        return Brand::select('id', 'name', 'slug')->get();
    }

    public function getSlidersProperty(): Collection
    {
        return Slider::active()->take(1)->get();
    }

    public function getFeaturedbannersProperty()
    {
        return FeaturedBanner::whereStatus(true)->get();
    }

    public function getSectionsProperty(): Collection
    {
        return Section::active()->limit(4)->get();
    }

    public function render(): View|Factory
    {
        return view('livewire.front.index')->extends('layouts.app');
    }
}
