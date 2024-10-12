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

    private function hasItems(): bool
    {
        $count = 0;
        if ($this->target->relationLoaded('cemeteries')) {
            $count += $this->target->cemeteries->count();
        }

        if ($this->target->relationLoaded('children')) {
            $count += $this->target->children->count();
        }

        return $count > 0;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.widgets.cemeteries.browse-locations', [
            'hasItems' => $this->hasItems(),
        ]);
    }
}
