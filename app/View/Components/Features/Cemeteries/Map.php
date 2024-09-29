<?php

namespace App\View\Components\Features\Cemeteries;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Map extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(

    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.features.cemeteries.map', [
            'zoom' => 6,
            'center' => null,
            'key' => config('app.mapbox.public_key'),
        ]);
    }
}
