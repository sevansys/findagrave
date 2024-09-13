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
                'name' => 'memorial',
                'label' => 'Memorials'
            ],
            [
                'name' => 'cemetery',
                'label' => 'Cemeteries'
            ],
            [
                'name' => 'famous',
                'label' => 'Famous'
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
