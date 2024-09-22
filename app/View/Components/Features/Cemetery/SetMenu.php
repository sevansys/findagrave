<?php

namespace App\View\Components\Features\Cemetery;

use App\Models\Cemetery;
use App\View\Components\Features\Actions\Main;

class SetMenu extends Main
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

    protected function getActions(): array
    {
        return [
            [
                'href' => '#',
                'icon' => 'add',
                'text' => 'Add Memorial',
            ],
            [
                'href' => '#',
                'icon' => 'upload-photo',
                'text' => 'Upload Headstone Photos',
            ],
        ];
    }
}
