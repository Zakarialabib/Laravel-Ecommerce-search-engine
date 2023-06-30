<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Product;

use App\Helpers;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Http\Livewire\Quill;

class Edit extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $product;

    public $editModal = false;

    public $image;

    public $category_id;

    public $gallery = [];

    public $width = 1000;

    public $height = 1000;

    public $description;

    public $options = [];

    public $listeners = [
        'optionUpdated' => 'updatedOptions',
        'editModal',
        Quill::EVENT_VALUE_UPDATED,
    ];

    protected $rules = [
        'product.code'             => ['nullable'],
        'product.slug'             => ['nullable'],
        'product.url'              => ['nullable', 'string', 'max:255'],
        'product.name'             => ['required', 'string', 'max:255'],
        'product.price'            => ['required', 'numeric', 'max:2147483647'],
        'product.old_price'        => ['required', 'numeric', 'max:2147483647'],
        'product.wholesale_price'  => ['nullable', 'numeric', 'max:2147483647'],
        'description'              => ['nullable'],
        'product.meta_title'       => ['nullable', 'string', 'max:255'],
        'product.meta_description' => ['nullable', 'string', 'max:255'],
        'product.meta_keywords'    => ['nullable', 'string', 'min:1'],
        'product.category_id'      => ['required', 'integer'],
        'product.subcategories'    => ['nullable', 'array', 'min:1'],
        'product.subcategories.*'  => ['integer', 'distinct:strict'],
        'options'                  => ['nullable', 'array'],
        'options.*.type'           => ['string', 'max:255'],
        'options.*.value'          => ['string', 'max:255'],
        'product.brand_id'         => ['nullable', 'integer'],
        'product.embeded_video'    => ['nullable'],
        'product.condition'        => ['nullable'],
    ];

    public function updatedDescription($value)
    {
        $this->description = $value;
    }

    public function getImagePreviewProperty()
    {
        return $this->product?->image;
    }

    public function getGalleryPreviewProperty()
    {
        return $this->product?->gallery;
    }

    public function getCategoriesProperty()
    {
        return Category::select('id', 'name')
            ->get();
    }

    public function getBrandsProperty()
    {
        return Brand::select('name', 'id')->get();
    }

    public function getSubcategoriesProperty()
    {
        return Subcategory::select('name', 'id')->get();
    }

    public function updatedProductSubcategories()
    {
        $this->product->subcategories;
    }

    public function addOption()
    {
        $this->options[] = [
            'type'  => '',
            'value' => '',
        ];
    }

    public function removeOption($index)
    {
        unset($this->options[$index]);
        $this->options = array_values($this->options);
    }

    public function editModal($id)
    {
        abort_if(Gate::denies('product_update'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->product = Product::findOrFail($id);

        $this->description = $this->product->description;

        $price = $this->product->price;
        $this->product->price = $price ? $price->price : null;
        $this->product->old_price = $price ? $price->old_price : null;
        $this->product->wholesale_price = $price ? $price->wholesale_price : null;

        $this->options = $this->product->options ?? [];

        $this->editModal = true;
    }

    public function update()
    {
        abort_if(Gate::denies('product_update'), 403);

        $this->validate();

        if ($this->image) {
            $imageName = Helpers::handleUpload($this->image, $this->width, $this->height, $this->product->name);

            $this->product->image = $imageName;
        }

        if ($this->gallery) {
            $gallery = [];

            foreach ($this->gallery as $key => $value) {
                $imageName = Helpers::handleUpload($value, $this->width, $this->height, $this->product->name);
                $gallery[] = $imageName;
            }

            $this->product->gallery = json_encode($gallery);
        }

        $this->product->options = $this->options;
        // Update Price entry
        $price = $this->product->price;
        $price->price = $this->product->price;
        $price->old_price = $this->product->old_price;
        $price->wholesale_price = $this->product->wholesale_price;
        $price->suggested_prices = $this->product->suggested_prices;
        $price->save();
        $this->product->save();

        $this->alert('success', __('Product updated successfully.'));

        $this->editModal = false;

        $this->emit('refreshIndex');
    }

    public function render(): View|Factory
    {
        return view('livewire.admin.product.edit');
    }
}
