<?php

declare(strict_types=1);

namespace App\Http\Livewire\Vendor\Product;

use App\Models\Product;
use App\Models\VendorHighlighted;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Highlighted extends Component
{
    use LivewireAlert;

    public $product;

    public $price;

    public $startDate;

    public $endDate;

    public $placement_type;

    public $pricePerDay = 100;

    public $listeners = [
        'highlightModal',
    ];

    public $highlightModal = false;

    protected $rules = [
        'placementType' => 'required|string',
        'startDate' => 'required|date|after:today',
        'endDate' => 'required|date|after:start_date',
    ];

    public function highlightModal($id): void
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->product = Product::findOrFail($id);

        $this->startDate = now()->toDateString();

        $this->endDate = now()->addDays(7)->toDateString();

        $this->highlightModal = true;
    }

    public function saveHighlight(): void
    {
        $this->validate();

        $numberOfDays = Carbon::parse($this->endDate)->diffInDays(Carbon::parse($this->startDate));
        $totalPrice = $this->pricePerDay * $numberOfDays;

        $vendorHighlighted = VendorHighlighted::updateOrCreate(
            [
                'vendor_id' => auth()->id(),
                'product_id' => $this->product->id,
            ],
            [
                'placement_type' => $this->placement_type,
                'price' => $totalPrice,
                'approved' => false,
                'start_date' => $this->startDate,
                'end_date' => $this->endDate,
            ]
        );

        $this->alert('success', 'Product highlighted successfully.');

        $this->highlightModal = false;
    }

    public function render(): View|Factory
    {
        return view('livewire.vendor.product.highlighted');
    }

    private function calculatePrice()
    {
        $startDate = \Carbon\Carbon::parse($this->startDate);
        $endDate = \Carbon\Carbon::parse($this->endDate);
        $diffInDays = $endDate->diffInDays($startDate);

        return $this->pricePerDay * $diffInDays;
    }

    private function getDescriptionForPlacementType($type)
    {
        switch ($type) {
            case 'featured':
                return 'Featured product';
            case 'hot':
                return 'Hot product';
            case 'best':
                return 'Best product';
            case 'top':
                return 'Top product';
            case 'latest':
                return 'Latest product';
            case 'trending':
                return 'Trending product';
            case 'sale':
                return 'Sale product';
            default:
                return '';
        }
    }
}
