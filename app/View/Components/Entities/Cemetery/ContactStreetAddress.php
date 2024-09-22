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

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.entities.cemetery.contact-street-address');
    }
}
