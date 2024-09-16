<?php

namespace App\View\Components\Entities\Cemetery;

use Closure;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ListItem extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public string $href,
        public ?string $image,
        public string $address,
        public int $withGpsCount = 0,
        public bool $withoutGps = false,
        public int $withMemorialsCount = 0,
        public int $withPhotoRequestsCount = 0,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.entities.cemetery.list-item');
    }
}
