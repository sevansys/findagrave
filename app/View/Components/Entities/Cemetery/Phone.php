<?php

namespace App\View\Components\Entities\Cemetery;

class Phone extends AboutItem
{
    protected function getProp(): string
    {
        return 'phone';
    }

    public function getViewPath(): string
    {
        return 'components.entities.cemetery.phone';
    }
}
