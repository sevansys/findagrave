<?php

namespace App\View\Components\Shared;

use Closure;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Checkbox extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string $name = null,
        public ?string $value = null,
        public ?string $label = null,
        public ?bool $checked = false,
        public ?bool $required = false,
        public ?string $labelClsx = null,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.shared.checkbox');
    }
}
