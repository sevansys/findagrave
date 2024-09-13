<?php

namespace App\Enums;

enum EnumLocation: int
{
    case CONTINENT = 1;
    case COUNTRY = 2;
    case STATE = 3;
    case COUNTY = 4;
    case CITY = 5;
}
