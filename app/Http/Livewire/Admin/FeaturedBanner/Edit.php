<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\FeaturedBanner;

use App\Models\FeaturedBanner;
use App\Models\Language;
use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $editModal = false;

    public $image;

    public $featuredbanner;

    public $description;

    public $listeners = ['editModal'];

    protected $rules = [
        'featuredbanner.title'         => ['required', 'string', 'max:255'],
        'description'                  => ['nullable', 'string'],
        'featuredbanner.link'          => ['nullable', 'string'],
        'featuredbanner.label'         => ['nullable', 'string'],
        'featuredbanner.product_id'    => ['nullable', 'integer'],
        'featuredbanner.language_id'   => ['nullable', 'integer'],
        'featuredbanner.embeded_video' => ['nullable'],
    ];

    public function updatedDescription($value): void
    {
        $this->description = $value;
    }

    public function render(): View|Factory
    {
        // abort_if(Gate::denies('featuredbanner_edit'), 403);

        return view('livewire.admin.featured-banner.edit');
    }

    public function editModal($featuredbanner): void
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->featuredbanner = FeaturedBanner::findOrFail($featuredbanner);

        $this->editModal = true;
    }

    public function update(): void
    {
        $this->validate();
        // if product selected Helpers::productLink($product)

        if ($this->image) {
            $imageName = Str::slug($this->featuredbanner->title).'-'.Str::random(3).'.'.$this->image->extension();
            $this->image->storeAs('featuredbanners', $imageName);
            $this->featuredbanner->image = $imageName;
        }

        $this->featuredbanner->description = $this->description;

        $this->featuredbanner->save();

        $this->alert('success', __('FeaturedBanner updated successfully.'));
        $this->emit('refreshIndex');

        $this->editModal = false;
    }

    public function getLanguagesProperty()
    {
        return Language::pluck('name', 'id')->toArray();
    }

    public function getProductsProperty()
    {
        return Product::pluck('name', 'id')->toArray();
    }
}
