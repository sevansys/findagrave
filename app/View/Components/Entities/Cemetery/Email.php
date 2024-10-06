<?php

namespace App\View\Components\Entities\Cemetery;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

use App\Models\Cemetery;

class Email extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Cemetery $target,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|string
    {
        if (empty($this->target->email)) {
            return '';
        }

        return view('components.entities.cemetery.email');
    }
}
