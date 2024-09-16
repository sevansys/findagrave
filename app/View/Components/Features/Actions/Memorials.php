<?php

namespace App\View\Components\Features\Actions;

use Closure;

use Illuminate\Contracts\View\View;

class Memorials extends Main
{
    protected function getActions(): array
    {
        return [
            [
                'icon' => 'grave',
                'text' => 'Add a Memorial',
                'href' => '#add-a-memorial',
            ],
            [
                'icon' => 'recent',
                'text' => 'Recently Added',
                'href' => '#recently-added',
            ],
            [
                'icon' => 'monument',
                'text' => 'Interesting Monuments',
                'href' => '#interesting-monuments',
            ],
            [
                'icon' => 'grave-interesting',
                'text' => 'Interesting Epitaphs',
                'href' => '#interesting-epitaphs',
            ]
        ];
    }
}
