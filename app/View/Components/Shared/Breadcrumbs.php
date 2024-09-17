<?php

namespace App\View\Components\Shared;

use Closure;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Breadcrumbs extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public array $items = [],
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.shared.breadcrumbs', [
            'items' => $this->items,
            'count' => count($this->items),
        ]);
    }
}
