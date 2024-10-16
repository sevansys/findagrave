<?php

namespace App\View\Components\Widgets\Cemetery;

use App\Models\Location;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

use App\Models\Cemetery;

class Footer extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Cemetery $target
    ) {}

    protected function getBreadcrumbs(): array
    {
        if (!$this->target->relationLoaded('additional_locations')) {
            return [];
        }

        return $this->target->additional_locations->map(function(Location $location) {
            $nav = $location->getForNavigation();

            $nav[] = [
                "href" => null,
                "text" => $this->target->name,
            ];

            return $nav;
        })->toArray();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        $breadcrumbs = $this->getBreadcrumbs();

        return view('components.widgets.cemetery.footer', [
            'id' => $this->target->id,
            'breadcrumbs' => $breadcrumbs,
            'created' => $this->target->created_at,
            'breadcrumbsCount' => count($breadcrumbs),
            'createdAtFormatted' => $this->target->created_at->format('d M Y'),
        ]);
    }
}
