<?php

namespace App\View\Components\Widgets\Cemeteries;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

use App\Models\Location;

class BrowseLocations extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?Location $target,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.widgets.cemeteries.browse-locations');
    }
}
