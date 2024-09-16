<?php

namespace App\View\Components\Features\Cemeteries;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Favorites extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct() {}

    protected function getItems(): array
    {
        return [
            [
                'href' => '#',
                'name' => 'Charbakh Cemetery',
                'address' => 'Yerevan, City of Yerevan, Yerevan, Armenia',
                'image' => 'https://images.findagrave.com/photos/2015/164/CEM2581870_1434337568.jpg?size=photos250',
            ],
            [
                'href' => '#',
                'name' => 'Charbakh Cemetery',
                'address' => 'Yerevan, City of Yerevan, Yerevan, Armenia',
                'image' => 'https://images.findagrave.com/photos/2015/164/CEM2581870_1434337568.jpg?size=photos250',
            ],
            [
                'href' => '#',
                'name' => 'Charbakh Cemetery',
                'address' => 'Yerevan, City of Yerevan, Yerevan, Armenia',
                'image' => 'https://images.findagrave.com/photos/2015/164/CEM2581870_1434337568.jpg?size=photos250',
            ],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.features.cemeteries.favorites', [
            'items' => $this->getItems()
        ]);
    }
}
