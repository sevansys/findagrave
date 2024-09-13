<?php

namespace App\Enums;

enum EnumYearFilter: int
{
    case EXACT = 1;
    case BEFORE = 2;
    case AFTER = 3;
    case PM_ONE = 4;
    case PM_THREE = 5;
    case PM_FIVE = 6;
    case PM_TEN = 7;
    case PM_TWENTY_FIVE = 8;
    case UNKNOWN = 9;

    public static function options(): array
    {
        return [
            [
                'label' => 'Exact',
                'value' => self::EXACT->value,
            ],
            [
                'label' => 'Before',
                'value' => self::BEFORE->value,
            ],
            [
                'label' => 'After',
                'value' => self::AFTER->value,
            ],
            [
                'label' => '+/- 1',
                'value' => self::PM_ONE->value,
            ],
            [
                'label' => '+/- 3',
                'value' => self::PM_THREE->value,
            ],
            [
                'label' => '+/- 5',
                'value' => self::PM_FIVE->value,
            ],
            [
                'label' => '+/- 10',
                'value' => self::PM_TEN->value,
            ],
            [
                'label' => '+/- 25',
                'value' => self::PM_TWENTY_FIVE->value,
            ],
            [
                'label' => 'Unknown',
                'value' => self::UNKNOWN->value,
            ],
        ];
    }
}
