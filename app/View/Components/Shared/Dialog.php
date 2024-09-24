<?php

namespace App\View\Components\Shared;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Dialog extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string $clsx = null,
        public ?string $dialogClsx = null,
        public ?string $containerClsx = null,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.shared.dialog');
    }
}
