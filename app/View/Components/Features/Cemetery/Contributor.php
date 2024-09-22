<?php

namespace App\View\Components\Features\Cemetery;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

use App\Models\Cemetery;

class Contributor extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Cemetery $target
    ) {}

    public function getPhotographed(): float
    {
        return 0;
    }

    public function getWithGPS(): float
    {
        return 0;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.features.cemetery.contributor', [
            'withGPS' => $this->getWithGPS(),
            'photographed' => $this->getPhotographed(),
        ]);
    }
}
