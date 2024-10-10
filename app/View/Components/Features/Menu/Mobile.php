<?php

namespace App\View\Components\Features\Menu;

use Illuminate\Contracts\View\View;

class Mobile extends Top
{
    public function render(): View
    {
        return view('components.features.menu.mobile', [
            'items' => [
                [
                    'name' => 'home',
                    'label' => 'Home',
                ],
                ...$this->getItems(),
            ],
        ]);
    }
}
