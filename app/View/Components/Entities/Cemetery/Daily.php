<?php

namespace App\View\Components\Entities\Cemetery;

use Closure;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Daily extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public ?string $href = null,
        public ?array $author = null,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.entities.cemetery.daily');
    }
}
