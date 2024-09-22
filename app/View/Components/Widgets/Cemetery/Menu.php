<?php

namespace App\View\Components\Widgets\Cemetery;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

use App\Models\Cemetery;

class Menu extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Cemetery $target
    ) {}

    protected function getMemorialsCount(): int
    {
        if (!$this->target->relationLoaded('memorials')) {
            return 0;
        }

        return $this->target->memorials?->count() ?? 0;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.widgets.cemetery.menu', [
            'memorialsCount' => $this->getMemorialsCount(),
        ]);
    }
}
