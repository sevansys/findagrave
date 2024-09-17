<?php

namespace App\View\Components\Features\Cemeteries;

use Closure;

use Illuminate\Support\Str;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

use App\Models\Cemetery;
use App\Models\Location;

class BrowseItems extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Location $location
    ) {}

    protected function getItems(): array
    {
        if (!$this->location->relationLoaded('cemeteries')) {
            return [];
        }

        return $this->location->cemeteries->map(function(Cemetery $cemetery) {
            return [
                'text' => $cemetery->name,
                'href' => route('cemetery.about', [
                    'slug' => Str::slug($cemetery->name),
                    'cemeteryAbout' => $cemetery->id,
                ])
            ];
        })->toArray();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.features.cemeteries.browse-items', [
            'items' => $this->getItems(),
        ]);
    }
}
