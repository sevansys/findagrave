<?php

namespace App\View\Components\Entities\Cemetery;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

use App\Models\Media;

class Photo extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Media $target,
        public string $alt,
        public bool $showDate = false,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.entities.cemetery.photo');
    }
}
