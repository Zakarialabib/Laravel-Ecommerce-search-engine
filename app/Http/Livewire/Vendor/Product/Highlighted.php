<?php

declare(strict_types=1);

namespace App\Http\Livewire\Vendor\Product;

use App\Models\Product;
use App\Models\VendorHighlighted;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Throwable;

class Highlighted extends Component
{
    use LivewireAlert;

    public $product;

    public $price;

    public $start_date;

    public $end_date;
    
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

    public function highlightModal($id)
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->product = Product::findOrFail($id);

        $this->startDate = now()->toDateString();
        
        $this->endDate = now()->addDays(7)->toDateString();

        $this->highlightModal = true;

    }

    public function saveHighlight()
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
                'price' => $this->price,
                'approved' => false,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
            ]
        );

        $this->alert('success', 'Product highlighted successfully.');

        $this->highlightModal = false;

    
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

    public function render(): View|Factory
    {
        return view('livewire.vendor.product.highlighted');
    }
}