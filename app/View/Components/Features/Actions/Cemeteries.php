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
                'href' => route('cemetery.create'),
            ],
            [
                'icon' => 'browse-location',
                'text' => 'Browse by Location',
                'href' => route('cemeteries-browse'),
            ],
        ];
    }
}
