<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Page;

use App\Models\Page;
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

    public $editModal;

    public $page;

    public $image;

    public $description;

    public $listeners = [
        'editModal',
    ];

    protected $rules = [
        'page.title'            => ['required', 'string', 'max:255'],
        'page.slug'             => ['required', 'max:255'],
        'description'           => ['required'],
        'description'           => ['nullable', 'max:65'],
        'page.meta_description' => ['nullable', 'max:170'],
        'page.language_id'      => ['nullable', 'integer'],
    ];

    protected $messages = [
        'page.title.required'       => 'The title cannot be empty.',
        'page.title.string'         => 'The title must be a string.',
        'page.title.max'            => 'The title may not be greater than 255 characters.',
        'page.slug.required'        => 'The slug cannot be empty.',
        'page.slug.max'             => 'The slug may not be greater than 255 characters.',
        'description.required'      => 'The description cannot be empty.',
        'description.max'           => 'The meta title may not be greater than 65 characters.',
        'page.meta_description.max' => 'The meta description may not be greater than 170 characters.',
        'page.language_id.integer'  => 'The language must be an integer.',
    ];

    public function updatedDescription($value): void
    {
        $this->description = $value;
    }

    public function render(): View|Factory
    {
        // abort_if(Gate::denies('page_edit'), 403);

        return view('livewire.admin.page.edit');
    }

    public function editModal($page): void
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->page = Page::findOrFail($page);

        $this->image = $this->page->image;

        $this->description = $this->page->description;

        $this->editModal = true;
    }

    public function update(): void
    {
        $this->validate();

        $this->page->slug = Str::slug($this->page->name);

        if ($this->image) {
            $imageName = Str::slug($this->page->name).'-'.date('Y-m-d H:i:s').'.'.$this->image->extension();
            $this->image->storeAs('pages', $imageName);
            $this->page->image = $imageName;
        }

        $this->page->description = $this->description;

        $this->page->save();

        $this->emit('refreshIndex');

        $this->alert('success', __('Page updated successfully.'));

        $this->editModal = false;
    }
}
