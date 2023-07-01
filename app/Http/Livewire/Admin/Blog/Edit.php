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

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $editModal = false;

    public $image;

    public $blog;

    public $description;

    public $listeners = ['editModal'];

    protected $rules = [
        'blog.title'            => 'required|min:3|max:255',
        'blog.category_id'      => 'required|integer',
        'blog.slug'             => 'required|string',
        'description'           => 'required|min:3',
        'blog.language_id'      => 'nullable|integer',
        'blog.meta_title'       => 'nullable|max:66',
        'blog.meta_description' => 'nullable|max:170',
    ];

    protected $messages = [
        'blog.title.required'       => 'The title cannot be empty.',
        'blog.title.min'            => 'The title must be at least 3 characters.',
        'blog.title.max'            => 'The title may not be greater than 255 characters.',
        'blog.category_id.required' => 'The category cannot be empty.',
        'blog.category_id.integer'  => 'The category must be an integer.',
        'blog.slug.required'        => 'The slug cannot be empty.',
        'blog.slug.string'          => 'The slug must be a string.',
        'description.required'      => 'The description cannot be empty.',
        'description.min'           => 'The description must be at least 3 characters.',
        'blog.language_id.integer'  => 'The language must be an integer.',
        'blog.meta_title.max'       => 'The meta title may not be greater than 66 characters.',
        'blog.meta_description.max' => 'The meta description may not be greater than 170 characters.',
    ];

    public function updatedDescription(): void
    {
        $this->description = $this->description;
    }

    public function render(): View|Factory
    {
        // abort_if(Gate::denies('blog_create'), 403);

        return view('livewire.admin.blog.edit');
    }

    public function editModal($id): void
    {
        // abort_if(Gate::denies('blog_edit'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->blog = Blog::where('id', $id)->firstOrFail();

        $this->description = $this->blog->description;

        $this->editModal = true;
    }

    public function update(): void
    {
        $this->validate();

        if ($this->image) {
            $imageName = Str::slug($this->blog->title).'.'.$this->image->extension();
            $this->image->storeAs('blogs', $imageName);
            $this->blog->image = $imageName;
        }

        $this->blog->description = $this->description;

        $this->blog->save();

        $this->emit('refreshIndex');

        $this->alert('success', __('Blog updated successfully.'));

        $this->editModal = false;
    }

    public function getBlogCategoriesProperty()
    {
        return BlogCategory::select('title', 'id')->get();
    }

    public function getLanguagesProperty()
    {
        return Language::select('name', 'id')->get();
    }
}
