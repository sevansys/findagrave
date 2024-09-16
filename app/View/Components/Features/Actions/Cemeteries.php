<?php

namespace App\View\Components\Features\Actions;

class Cemeteries extends Main
{
    protected function getActions(): array
    {
        return [
            [
                'icon' => 'add',
                'text' => 'Add a Cemetery',
                'href' => '#add-a-cemetery',
            ],
            [
                'icon' => 'browse-location',
                'text' => 'Browse by Location',
                'href' => '#browse-by-Location',
            ],
        ];
    }
}
