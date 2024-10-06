<?php

namespace App\View\Components\Entities\Cemetery;

class AdditionalInfo extends AboutItem
{
    protected function getProp(): string
    {
        return 'additional_info';
    }

    protected function getViewPath(): string
    {
        return 'components.entities.cemetery.additional-info';
    }
}
