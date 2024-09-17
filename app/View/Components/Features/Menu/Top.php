<?php

namespace App\View\Components\Features\Menu;

use Closure;

use Illuminate\Contracts\View\View;

class Top extends Menu
{

    public function getItems(): array
    {
        return [
            [
                'label' => 'Memorials',
                'name' => 'memorials-index',
            ],
            [
                'label' => 'Cemeteries',
                'name' => 'cemeteries-index',
            ],
            [
                'label' => 'Famous',
                'name' => 'famous-index',
            ],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.features.menu.top', [
            "items" => $this->getMenu()
        ]);
    }
}
