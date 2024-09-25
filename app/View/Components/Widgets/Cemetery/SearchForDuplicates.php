<?php

namespace App\View\Components\Widgets\Cemetery;

use App\Enums\EnumLocation;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SearchForDuplicates extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct() {}

    protected function getTypes(): array
    {
        return [
            EnumLocation::CITY,
            EnumLocation::COUNTY,
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.widgets.cemetery.search-for-duplicates', [
            'types' => $this->getTypes(),
        ]);
    }
}
