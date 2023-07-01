<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Blog;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Language;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $createBlog = false;

    public $image;

    public $blog;

    public $listeners = ['createBlog'];

    protected $rules = [
        'blog.title' => 'required|min:3|max:255',
        'blog.category_id' => 'required|integer',
        'blog.details' => 'required|min:3',
        'blog.language_id' => 'nullable|integer',
        'blog.meta_title' => 'nullable|max:65',
        'blog.meta_description' => 'nullable|max:170',
    ];

    protected $messages = [
        'blog.title.required' => 'The title cannot be empty.',
        'blog.title.min' => 'The title must be at least 3 characters.',
        'blog.title.max' => 'The title may not be greater than 255 characters.',
        'blog.category_id.required' => 'The category cannot be empty.',
        'blog.category_id.integer' => 'The category must be an integer.',
        'blog.details.required' => 'The details cannot be empty.',
        'blog.details.min' => 'The details must be at least 3 characters.',
        'blog.language_id.integer' => 'The language must be an integer.',
        'blog.meta_title.max' => 'The meta title may not be greater than 65 characters.',
        'blog.meta_description.max' => 'The meta description may not be greater than 170 characters.',
    ];

    public function mount(Blog $blog): void
    {
        $this->blog = $blog;

        $this->initListsForFields();
    }

    public function render(): View|Factory
    {
        // abort_if(Gate::denies('blog_create'), 403);

        return view('livewire.admin.blog.create');
    }

    public function createBlog(): void
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->createBlog = true;
    }

    public function create(): void
    {
        $this->validate();

        $this->blog->slug = Str::slug($this->blog->title);

        if ($this->image) {
            $imageName = Str::slug($this->blog->title).'.'.$this->image->extension();
            $this->image->storeAs('blogs', $imageName);
            $this->blog->image = $imageName;
        }

        $this->blog->save();

        $this->emit('refreshIndex');

        $this->alert('success', __('Blog created successfully.'));

        $this->createBlog = false;
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['categories'] = BlogCategory::pluck('title', 'id')->toArray();
        $this->listsForFields['languages'] = Language::pluck('name', 'id')->toArray();
    }
}
