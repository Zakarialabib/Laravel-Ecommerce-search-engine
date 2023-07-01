<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\FeaturedBanner;

use App\Http\Livewire\WithSorting;
use App\Models\FeaturedBanner;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use WithSorting;
    use LivewireAlert;
    use WithFileUploads;

    public $featuredbanner;

    public $listeners = [
        'refreshIndex' => '$refresh',
        'showModal', 'delete',
    ];

    public $showModal = false;

    public $refreshIndex;

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;

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

    public function mount(): void
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 25;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new FeaturedBanner())->orderable;
    }

    public function render(): View|Factory
    {
        $query = FeaturedBanner::advancedFilter([
            's' => $this->search ?: null,
            'order_column' => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $featuredbanners = $query->paginate($this->perPage);

        return view('livewire.admin.featured-banner.index', compact('featuredbanners'));
    }

    public function setFeatured($id): void
    {
        FeaturedBanner::where('featured', '=', true)->update(['featured' => false]);
        $featuredbanner = FeaturedBanner::findOrFail($id);
        $featuredbanner->featured = true;
        $featuredbanner->save();

        $this->alert('success', __('Featuredbanner featured successfully!'));
    }

    public function showModal(FeaturedBanner $featuredbanner): void
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->featuredbanner = $featuredbanner;

        $this->showModal = true;
    }

    public function delete(FeaturedBanner $featuredbanner): void
    {
        $featuredbanner->delete();

        $this->alert('success', __('FeaturedBanner deleted successfully.'));
    }
}
