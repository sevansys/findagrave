<?php

namespace App\View\Components\Shared;

use Closure;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ContentAd extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string $h = '48',
        public ?string $w = 'full',
        public ?string $clsx = null,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.shared.content-ad');
    }
}
