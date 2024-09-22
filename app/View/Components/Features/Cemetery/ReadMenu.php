<?php

namespace App\View\Components\Features\Cemetery;

use App\Models\Cemetery;
use App\View\Components\Features\Actions\Main;

class ReadMenu extends Main
{
    public function __construct(
        public Cemetery $target,
        public int $gap = 4,
        public string $align = 'end',
        public string $justify = 'center',
    )
    {
        parent::__construct($gap, $align, $justify);
    }

    public function getActions(): array
    {
        return [
            [
                'count' => 0,
                'href' => '#',
                'icon' => 'grave',
                'text' => 'View Memorials',
            ],
            [
                'href' => '#',
                'count' => null,
                'icon' => 'recent',
                'text' => 'Recent Memorials',
            ],
        ];
    }
}
