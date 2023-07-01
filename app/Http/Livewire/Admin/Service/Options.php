<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Service;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Options extends Component
{
    public $options;

    public function updatedOptions($options): void
    {
        $options = [];

        foreach ($options as $option) {
            if (! empty($option['type']) && ! empty($option['value'])) {
                $this->options[] = $option;
            }
        }

        $this->emitUp('optionUpdated', $this->options);
    }

    public function addOption(): void
    {
        $this->options[] = [
            'type' => '',
            'value' => '',
        ];
    }

    public function removeOption($index): void
    {
        unset($this->options[$index]);
        $this->options = array_values($this->options);
    }

    public function mount(): void
    {
        $this->options = [
            [
                'type' => '',
                'value' => '',
            ],
        ];
    }

    public function render(): View
    {
        return view('livewire.admin.service.options');
    }
}
