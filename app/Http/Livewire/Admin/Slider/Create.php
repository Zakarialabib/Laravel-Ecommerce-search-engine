<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Slider;

use App\Models\Language;
use App\Models\Slider;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $createModal = false;

    public $slider;

    public $image;

    public $description;

    public $listeners = [
        'createModal',
    ];

    public array $rules = [
        'slider.title'         => ['required', 'string', 'max:255'],
        'slider.subtitle'      => ['nullable', 'string'],
        'description'          => ['nullable', 'string'],
        'slider.link'          => ['nullable', 'string'],
        'slider.language_id'   => ['nullable'],
        'slider.bg_color'      => ['nullable'],
        'slider.embeded_video' => ['nullable'],
        'image'                => ['required'],
    ];

    public function updatedDescription($value): void
    {
        $this->description = $value;
    }

    public function render(): View|Factory
    {
        abort_if(Gate::denies('slider_create'), 403);

        return view('livewire.admin.slider.create');
    }

    public function createModal(): void
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->slider = new Slider();

        $this->createModal = true;
    }

    public function create(): void
    {
        $this->validate();

        if ($this->image) {
            $imageName = Str::slug($this->slider->title).'-'.Str::random(5).'.'.$this->image->extension();

            $img = Image::make($this->image->getRealPath())->encode('webp', 85);

            $img->stream();

            Storage::disk('local_files')->put('sliders/'.$imageName, $img, 'public');

            $this->slider->image = $imageName;
        }

        $this->slider->description = $this->description;

        $this->slider->save();

        $this->alert('success', __('Slider created successfully.'));

        $this->emit('refreshIndex');

        $this->createModal = false;
    }

    public function getLanguagesProperty(): Collection
    {
        return Language::select('name', 'id')->get();
    }
}
