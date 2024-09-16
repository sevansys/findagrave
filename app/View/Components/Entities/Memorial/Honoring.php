<?php

namespace App\View\Components\Entities\Memorial;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Honoring extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public string $href,
        public string $birth,
        public string $death,
        public string $image,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.entities.memorial.honoring');
    }
}
