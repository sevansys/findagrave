<?php

namespace App\Enums;

enum EnumVisibility: int
{
    case PUBLIC = 1;
    case PRIVATE = 2;
    case NO_LONGER_EXISTS_OR_HAS_BEEN_REMOVED = 3;
}
