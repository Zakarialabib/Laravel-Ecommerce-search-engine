<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\BlogCategory;

use App\Models\BlogCategory;
use App\Models\Language;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $createBlogCategory = false;

    public $listeners = ['createBlogCategory'];

    public $blogcategory;

    protected $rules = [
        'blogcategory.title'            => 'required|string|max:255',
        'blogcategory.description'      => 'nullable',
        'blogcategory.meta_title'       => 'nullable|max:65',
        'blogcategory.meta_description' => 'nullable|max:170',
        'blogcategory.language_id'      => 'required|integer',
    ];

    protected $messages = [
        'blogcategory.title.required'       => 'The title cannot be empty.',
        'blogcategory.title.string'         => 'The title must be a string.',
        'blogcategory.title.max'            => 'The title may not be greater than 255 characters.',
        'blogcategory.meta_title.max'       => 'The meta title may not be greater than 65 characters.',
        'blogcategory.meta_description.max' => 'The meta description may not be greater than 170 characters.',
        'blogcategory.language_id.required' => 'The language cannot be empty.',
        'blogcategory.language_id.integer'  => 'The language must be an integer.',
    ];

    public function render(): View|Factory
    {
        abort_if(Gate::denies('blogcategory_create'), 403);

        return view('livewire.admin.blog-category.create');
    }

    public function createBlogCategory(): void
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->blogcategory = new BlogCategory();

        $this->createBlogCategory = true;
    }

    public function create(): void
    {
        $this->validate();

        $this->blogcategory->save();

        $this->alert('success', __('BlogCategory created successfully.'));

        $this->createBlogCategory = false;

        $this->emit('refreshIndex');
    }

    public function getLanguagesProperty(): Collection
    {
        return Language::select('name', 'id')->get();
    }
}
