<?php

namespace App\View\Components\Widgets\Memorial;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ChooseLocation extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.widgets.memorial.choose-location');
    }
}
