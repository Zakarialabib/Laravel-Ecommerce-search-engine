<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\BlogCategory;

use App\Models\BlogCategory;
use App\Models\Language;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Edit extends Component
{
    use LivewireAlert;

    public $blogcategory;

    public $editModal = false;

    public $listeners = [
        'editModal',
    ];

    protected $rules = [
        'blogcategory.title' => 'required|string|max:255',
        'blogcategory.description' => 'nullable',
        'blogcategory.meta_title' => 'nullable|max:65',
        'blogcategory.meta_description' => 'nullable|max:170',
        'blogcategory.language_id' => 'required|integer',
    ];

    protected $messages = [
        'blogcategory.title.required' => 'The title cannot be empty.',
        'blogcategory.title.string' => 'The title must be a string.',
        'blogcategory.title.max' => 'The title may not be greater than 255 characters.',
        'blogcategory.description.required' => 'The description cannot be empty.',
        'blogcategory.meta_title.max' => 'The meta title may not be greater than 65 characters.',
        'blogcategory.meta_description.max' => 'The meta description may not be greater than 170 characters.',
        'blogcategory.language_id.required' => 'The language cannot be empty.',
        'blogcategory.language_id.integer' => 'The language must be an integer.',
    ];

    public function editModal($blogcategory): void
    {
        // abort_if(Gate::denies('blogcategory_edit'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->blogcategory = BlogCategory::findOrFail($blogcategory);

        $this->editModal = true;
    }

    public function update(): void
    {
        $this->validate();

        $this->blogcategory->save();

        $this->alert('success', __('BlogCategory updated successfully'));

        $this->editModal = false;

        $this->emit('refreshIndex');
    }

    public function getLanguagesProperty(): Collection
    {
        return Language::select('name', 'id')->get();
    }

    public function render(): View
    {
        return view('livewire.admin.blog-category.edit');
    }
}
