<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Page;

use App\Models\Page;
use App\Models\PageSetting;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Template extends Component
{
    use LivewireAlert;

    use WithFileUploads;

    public $templates = [];
    public $selectedTemplate = [];
    public $createTemplate = null;
    public $pages = [];
    public $selectTemplate;

    public $listeners = [
        'createTemplate',
    ];

    public function mount(): void
    {
        $this->templates = config('templates');
    }

    public function createTemplate(): void
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->createTemplate = true;
    }

    public function updatedSelectTemplate(): void
    {
        $this->selectedTemplate = $this->templates[$this->selectTemplate];
    }

    public function create(): void
    {
        // try {
        $pageTemplate = [
            'title'            => $this->selectedTemplate['title'],
            'slug'             => $this->selectedTemplate['slug'],
            'details'          => $this->selectedTemplate['details'],
            'meta_title'       => $this->selectedTemplate['meta_title'],
            'meta_description' => $this->selectedTemplate['meta_description'],
            'photo'            => $this->selectedTemplate['image'],
        ];

        $page = Page::create($pageTemplate);

        $pageSettings = new PageSetting([
            'page_id' => $page->id,
            // 'language_id' => $page->language_id ?? null,
        ]);

        $this->emit('refreshIndex');

        $this->createTemplate = false;

        $this->alert('success', __('Page created successfully!'));
        // } catch (Throwable $th) {
        //     $this->alert('warning', __('Page Was not created!'));
        // }
    }

    public function render()
    {
        return view('livewire.admin.page.template');
    }
}
