<?php

namespace App\Enums;

enum EnumLocation: int
{
    case CONTINENT = 1;
    case COUNTRY = 2;
    case STATE = 3;
    case COUNTY = 4;
    case CITY = 5;

    public static function label(self $type): string
    {
        return match ($type) {
            EnumLocation::CITY => 'City',
            EnumLocation::STATE => 'State',
            EnumLocation::COUNTY => 'County',
            EnumLocation::COUNTRY => 'Country',
            EnumLocation::CONTINENT => 'Continent',
        };
    }
}
