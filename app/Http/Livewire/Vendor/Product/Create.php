<?php

declare(strict_types=1);

namespace App\Http\Livewire\Vendor\Product;

use App\Helpers;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $listeners = [
        'createModal',
    ];

    public $createModal = false;

    public $product;

    public $image;

    public $gallery = [];

    public $options = [];

    public $uploadLink;

    public $description;

    public $width = 1000;

    public $height = 1000;

    public array $listsForFields = [];

    protected $rules = [
        'product.name'             => ['required', 'string', 'max:255'],
        'product.price'            => ['required', 'numeric', 'max:2147483647'],
        'product.old_price'        => ['required', 'numeric', 'max:2147483647'],
        'description'              => ['nullable'],
        'product.meta_title'       => ['nullable', 'string', 'max:65'],
        'product.meta_description' => ['nullable', 'string', 'max:170'],
        'product.meta_keywords'    => ['nullable', 'string', 'min:1'],
        'product.category_id'      => ['required', 'integer'],
        'options.*.type'           => ['required', 'string', 'in:color,size'],
        'options.*.value'          => ['required_if:options.*.type,color', 'string'],
        'product.brand_id'         => ['nullable', 'integer'],
        'product.embeded_video'    => ['nullable'],
        'product.condition'        => ['nullable'],
    ];

    public function updatedDescription($value): void
    {
        $this->description = $value;
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function getImagePreviewProperty()
    {
        return $this->product->image;
    }

    public function getGalleryPreviewProperty()
    {
        return $this->product->gallery;
    }

    public function render(): View|Factory
    {
        return view('livewire.vendor.product.create');
    }

    public function createModal(): void
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->product = new Product();

        $this->createModal = true;
    }

    public function create(): void
    {
        $this->validate();

        $this->product->code = Str::slug($this->product->name, '-');

        $this->product->slug = Str::slug($this->product->name);

        if ($this->image) {
            $imageName = Helpers::handleUpload($this->image, $this->width, $this->height, $this->product->name);

            $this->product->image = $imageName;
        }

        if ($this->gallery) {
            $gallery = [];

            foreach ($this->gallery as $image) {
                $imageName = Str::slug($this->product->name).'.'.$image->extension();
                $image->storeAs('products', $imageName);
                $gallery[] = $imageName;
            }
            $this->product->gallery = json_encode($gallery);
        }

        $user = User::find(Auth::id());

        $this->product->store_id = $user->store->id;

        $this->product->save();

        $this->alert('success', 'Product created successfully');

        $this->emit('refreshIndex');

        $this->createModal = false;
    }

    public function getCategoriesProperty()
    {
        return Category::select('name', 'id')->get();
    }

    public function getBrandsProperty()
    {
        return Brand::select('name', 'id')->get();
    }

  
}
