<?php

namespace App\View\Components\Features\Locations;

use Closure;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

use App\Models\Location;

class BrowseItems extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Location $location
    ) {}

    public function getItems(): array
    {
        if (!$this->location->relationLoaded('children')) {
            return [];
        }

        return $this->location->children->map(function(Location $location) {
            return [
                'text' => $location->text,
                'href' => $this->getHref($location),
            ];
        })->toArray();
    }

    private function getHref(Location $location): string
    {
        return route('cemeteries-browse', [
            'slug' => sprintf('%d/%s',
                $location->id,
                $location->text,
            )
        ]);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.features.locations.browse-items', [
            'items' => $this->getItems(),
        ]);
    }
}
