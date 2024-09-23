<?php

namespace App\View\Components\Widgets\Cemetery;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

use App\Models\Cemetery;

class MapInfo extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Cemetery $target
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.widgets.cemetery.map-info');
    }
}
