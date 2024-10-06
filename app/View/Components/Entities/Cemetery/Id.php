<?php

namespace App\View\Components\Entities\Cemetery;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

use App\Models\Cemetery;

class Id extends AboutItem
{
    protected function getProp(): string
    {
        return 'id';
    }

    public function getViewPath(): string
    {
        return 'components.entities.cemetery.id';
    }
}
