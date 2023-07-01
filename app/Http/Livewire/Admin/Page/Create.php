<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Page;

use App\Models\Page;
use App\Models\PageSetting;
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

    public $createPage;

    public $page;

    public $image;

    public $description;

    public $listeners = [
        'createPage',
    ];

    protected $rules = [
        'page.title' => ['required', 'string', 'max:255'],
        'page.slug' => ['required', 'max:255'],
        'description' => ['required'],
        'page.meta_title' => ['nullable', 'max:65'],
        'page.meta_description' => ['nullable', 'max:170'],
        'page.language_id' => ['nullable'],
    ];

    protected $messages = [
        'page.title.required' => 'The title cannot be empty.',
        'page.title.string' => 'The title must be a string.',
        'page.title.max' => 'The title may not be greater than 255 characters.',
        'page.slug.required' => 'The slug cannot be empty.',
        'page.slug.max' => 'The slug may not be greater than 255 characters.',
        'description.required' => 'The details cannot be empty.',
        'page.meta_title.max' => 'The meta title may not be greater than 65 characters.',
        'page.meta_description.max' => 'The meta description may not be greater than 170 characters.',
        'page.language_id.integer' => 'The language must be an integer.',
    ];

    public function updatedDescription($value): void
    {
        $this->description = $value;
    }

    public function render(): View|Factory
    {
        // abort_if(Gate::denies('page_create'), 403);

        return view('livewire.admin.page.create');
    }

    public function createPage(): void
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->page = new Page();

        $this->description = $this->page->details;

        $this->createPage = true;
    }

    public function create(): void
    {
        $this->validate();

        $this->page->slug = Str::slug($this->page->name);

        if ($this->photo) {
            $imageName = Str::slug($this->page->name).'-'.date('Y-m-d H:i:s').'.'.$this->photo->extension();
            $this->photo->storeAs('pages', $imageName);
            $this->page->photo = $imageName;
        }

        $this->page->save();

        $pageSettings = new PageSetting([
            'page_id' => $this->page->id,
            'language_id' => $this->page->language_id,
        ]);

        $this->emit('refreshIndex');

        $this->alert('success', __('Page created successfully!'));

        $this->createPage = false;
    }
}
