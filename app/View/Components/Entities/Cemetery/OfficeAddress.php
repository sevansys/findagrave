<?php

namespace App\View\Components\Entities\Cemetery;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

use App\Models\Cemetery;

class OfficeAddress extends AboutItem
{
    protected function getProp(): string
    {
        return 'office_address';
    }

    public function getViewPath(): string
    {
        return 'components.entities.cemetery.office-address';
    }
}
