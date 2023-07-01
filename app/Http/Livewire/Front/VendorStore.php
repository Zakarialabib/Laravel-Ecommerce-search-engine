<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class VendorStore extends Component
{
    use WithPagination;

    public $listeners = [
        'load-more' => 'loadMore',
    ];

    public int $perPage;
    public $sorting;
    public $vendor;
    public array $paginationOptions;
    public array $sortingOptions;

    public function mount($slug): void
    {
        $this->vendor = Store::whereSlug($slug)->firstOrFail();

        $this->paginationOptions = [25, 50, 100];
        $this->perPage = 25;
        $this->sortingOptions = [
            'name-asc'   => __('Order Alphabetic, A-Z'),
            'name-desc'  => __('Order Alphabetic, Z-A'),
            'price-asc'  => __('Price, low to high'),
            'price-desc' => __('Price, high to low'),
            'date-asc'   => __('Date, new to old'),
            'date-desc'  => __('Date, old to new'),
        ];
    }

    public function loadMore(): void
    {
        $this->perPage += 25;
    }

    public function rateProduct($productId, $rating): void
    {
        // Save the rating provided by the user for the specified product
        // This could involve updating the product's rating in the database or triggering an event to handle the rating process
    }

    public function followVendor(): void
    {
        // Add the current user as a follower of the vendor
        // This could involve updating the vendor's follower count or triggering an event to handle the follow process
    }

    public function sendMessage(): void
    {
        // Implement the logic to send a message to the vendor
        // This could involve sending an email or triggering a notification to notify the vendor about the new message
    }

    public function render(): View
    {
        $query = Product::active()
            ->where('store_id', $this->vendor->id);

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

        $this->emit('producteModalLoaded', $products->count());

        return view('livewire.front.vendor-store', compact('products'))->extends('layouts.app');
    }
}
