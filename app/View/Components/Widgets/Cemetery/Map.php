<?php

namespace App\View\Components\Widgets\Cemetery;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

use App\Models\Cemetery;

class Map extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Cemetery $target
    ) {}

    protected function isHasCoordinates(): bool
    {
        return !is_null($this->target->latitude) && !is_null($this->target->longitude);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.widgets.cemetery.map', [
            'hasCoordinates' => $this->isHasCoordinates(),
        ]);
    }
}
