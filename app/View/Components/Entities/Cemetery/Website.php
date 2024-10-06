<?php

namespace App\View\Components\Entities\Cemetery;

class Website extends AboutItem
{
    protected function getProp(): string
    {
        return 'website';
    }

    public function getViewPath(): string
    {
        return 'components.entities.cemetery.website';
    }
}
