<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Slider;

use App\Models\Language;
use App\Models\Slider;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $listeners = [
        'editModal',
    ];

    public $editModal = false;

    public $slider;

    public $umage;

    public $description;

    protected $rules = [
        'slider.title'         => ['required', 'string', 'max:255'],
        'slider.subtitle'      => ['nullable', 'string', 'max:255'],
        'description'          => ['nullable'],
        'slider.link'          => ['nullable', 'string'],
        'slider.language_id'   => ['nullable', 'integer'],
        'slider.bg_color'      => ['nullable', 'string'],
        'slider.embeded_video' => ['nullable'],
    ];

    public function updatedDescription($value): void
    {
        $this->description = $value;
    }

    public function editModal(Slider $slider): void
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->slider = $slider;

        $this->description = $slider->description;

        $this->editModal = true;
    }

    public function update(): void
    {
        $this->validate();

        if ($this->umage) {
            $imageName = Str::slug($this->slider->title).'-'.Str::random(5).'.'.$this->umage->extension();

            $img = Image::make($this->umage->getRealPath())->encode('webp', 85);

            $img->stream();

            Storage::disk('local_files')->put('sliders/'.$imageName, $img, 'public');

            $this->slider->umage = $imageName;
        }

        $this->slider->save();

        $this->alert('success', __('Slider updated successfully.'));

        $this->editModal = false;
    }

    public function getLanguagesProperty(): Collection
    {
        return Language::select('name', 'id')->get();
    }

    public function render(): View
    {
        return view('livewire.admin.slider.edit');
    }
}
