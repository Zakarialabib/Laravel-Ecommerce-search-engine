<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Page;

use App\Http\Livewire\WithSorting;
use App\Models\PageSetting;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Settings extends Component
{
    use LivewireAlert;
    use WithPagination;
    use WithSorting;

    public $header;
    public $footer;
    public $bottomBar;
    public $topHeader;
    public $bottomFooter;

    public $themeColor;
    public $popularProducts;
    public $flashDeal;
    public $bestSellers;
    public $topBrands;

    public $status;

    public $featured_banner_id;
    public $page_id;
    public $language_id;

    public $settings;

    public $createSettingsModal = false;
    public $showHeaderModal = false;
    public $showFooterModal = false;
    public $topHeaderModal = false;
    public $bottomFooterModal = false;

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;

    public array $listsForFields = [];

    protected $queryString = [
        'search' => [
            'except' => '',
        ],
        'sortBy' => [
            'except' => 'id',
        ],
        'sortDirection' => [
            'except' => 'desc',
        ],
    ];

    public function getSelectedCountProperty()
    {
        return count($this->selected);
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingPerPage(): void
    {
        $this->resetPage();
    }

    public function resetSelected(): void
    {
        $this->selected = [];
    }

    public function topHeaderModal(): void
    {
        $this->topHeaderModal = ! $this->topHeaderModal;
    }

    public function bottomFooterModal(): void
    {
        $this->bottomFooterModal = ! $this->bottomFooterModal;
    }

    public function updatePageSettings($id): void
    {
        $this->settings = PageSettings::where('page_id', $id)->first();

        $this->validate([
            'settings.header'             => 'nullable|string',
            'settings.footer'             => 'nullable|string',
            'settings.bottomBar'          => 'nullable|string',
            'settings.topHeader'          => 'nullable|string',
            'settings.bottomFooter'       => 'nullable|string',
            'settings.themeColor'         => 'nullable|string',
            'settings.popularProducts'    => 'nullable|string',
            'settings.flashDeal'          => 'nullable|string',
            'settings.bestSellers'        => 'nullable|string',
            'settings.topBrands'          => 'nullable|string',
            'settings.status'             => 'nullable|string',
            'settings.featured_banner_id' => 'nullable|string',
            'settings.page_id'            => 'nullable|string',
            'settings.language_id'        => 'nullable|string',

        ]);

        $this->settings->save();

        $this->alert('success', 'Settings updated successfully.');
    }

    public function mount(): void
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 25;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new Pagesetting())->orderable;
    }

    public function render()
    {
        $query = Pagesetting::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $pagesettings = $query->paginate($this->perPage);

        return view('livewire.admin.page.settings', compact('pagesettings'));
    }
}
