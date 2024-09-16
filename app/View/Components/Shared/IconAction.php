<?php

namespace App\View\Components\Shared;

use Closure;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class IconAction extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string $href = null,
        public ?string $iconName = null,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.shared.icon-action');
    }
}
