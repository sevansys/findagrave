<?php

namespace App\Enums;

enum EnumVisibility: int
{
    case PUBLIC = 1;
    case PRIVATE = 2;
    case NO_LONGER_EXISTS_OR_HAS_BEEN_REMOVED = 3;

    public static function asOptions(): array
    {
        return [
            [
                'label' => 'Public',
                'value' => self::PUBLIC->value,
            ],
            [
                'label' => 'Private',
                'value' => self::PRIVATE->value,
            ],
            [
                'label' => 'No longer exists or has been removed',
                'value' => self::NO_LONGER_EXISTS_OR_HAS_BEEN_REMOVED->value,
            ],
        ];
    }
}
