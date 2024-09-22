<?php

namespace App\View\Components\Shared;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ActionBtn extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string $iconName = null,
        public ?string $clsx = null,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.shared.action-btn');
    }
}
