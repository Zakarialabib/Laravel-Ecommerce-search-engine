<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Http\Livewire\WithSorting;
use App\Models\Store;
use Livewire\Component;
use Livewire\WithPagination;

class Market extends Component
{
    use WithPagination;
    use WithSorting;

    public int $perPage;

    public string $search = '';

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

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingPerPage(): void
    {
        $this->resetPage();
    }

    public function mount(): void
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 10;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new Product())->orderable;
    }

    public function render()
    {
        $query = Store::where('name', 'like', '%'.$this->search.'%')
            ->advancedFilter([
                's'               => $this->search ?: null,
                'order_column'    => $this->sortBy,
                'order_direction' => $this->sortDirection,
            ]);

        $stores = $query->paginate($this->perPage);

        return view('livewire.front.market', [
            'stores' => $stores,
        ])->extends('layouts.app');
    }
}
