<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\View\Component;

class SelectList extends Component
{
    public $options;

    /**
     * Create a new component instance.
     *
     * @param  mixed  $id
     */
    public function __construct(mixed $options)
    {
        $this->options = $options;
    }

    /** Get the view / contents that represent the component. */
    public function render(): \Illuminate\Contracts\View\View|string
    {
        return view('components.select-list');
    }
}
