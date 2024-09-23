<?php

namespace App\View\Components\Entities\Cemetery;

use App\Models\Cemetery;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ContactStreetAddress extends Component
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
        return view('components.entities.cemetery.contact-street-address', [
            'hasCoordinates' => $this->isHasCoordinates(),
        ]);
    }
}
