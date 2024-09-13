<?php

namespace App\Enums;

enum EnumDateAdded: int
{
    case NONE = 0;
    case ALL = 1;
    case LAST_24_HOURS = 2;
    case LAST_7_DAYS = 3;
    case LAST_30_DAYS = 4;
    case LAST_90_DAYS = 5;

    public static function options(): array
    {
        return [
            [
                'label' => '',
                'value' => self::NONE->value,
            ],
            [
                'label' => 'All Names',
                'value' => self::ALL->value,
            ],
            [
                'label' => 'Added in last 24 hours',
                'value' => self::LAST_24_HOURS->value,
            ],
            [
                'label' => 'Added in last 7 days',
                'value' => self::LAST_7_DAYS->value,
            ],
            [
                'label' => 'Added in last 60 days',
                'value' => self::LAST_30_DAYS->value,
            ],
            [
                'label' => 'Added in last 90 days',
                'value' => self::LAST_90_DAYS->value,
            ],
        ];
    }
}
