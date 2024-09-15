<?php

namespace App\Enums;

enum EnumOrderBy: int
{
    case NONE = 0;
    case NAME_A_Z = 1;
    case NAME_Z_A = 2;
    case BIRTH_DATE_OLDER = 3;
    case BIRTH_DATE_NEWER = 4;
    case DEATH_DATE_OLDER = 5;
    case DEATH_DATE_NEWER = 6;
    case CEMETERY_A_Z = 7;
    case CEMETERY_Z_A = 8;
    case PLOT = 9;

    public static function options(): array
    {
        return [
            [
                'label' => 'None',
                'value' => self::NONE->value,
            ],
            [
                'label' => 'Name (A-Z)',
                'value' => self::NAME_A_Z->value,
            ],
            [
                'label' => 'Name (Z-A)',
                'value' => self::NAME_Z_A->value,
            ],
            [
                'label' => 'Birth Date (Older)',
                'value' => self::BIRTH_DATE_OLDER->value,
            ],
            [
                'label' => 'Birth Date (Newer)',
                'value' => self::BIRTH_DATE_NEWER->value,
            ],
            [
                'label' => 'Death Day (Older)',
                'value' => self::DEATH_DATE_OLDER->value,
            ],
            [
                'label' => 'Death Day (Newer)',
                'value' => self::DEATH_DATE_NEWER->value,
            ],
            [
                'label' => 'Cemetery (A-Z)',
                'value' => self::CEMETERY_A_Z->value,
            ],
            [
                'label' => 'Cemetery (Z-A)',
                'value' => self::CEMETERY_Z_A->value,
            ],
            [
                'label' => 'Plot',
                'value' => self::PLOT->value,
            ],
        ];
    }
}
