<?php

namespace App\Enums\Relationship;

enum EnumParentRelationship: int
{
    case PARENT = 1;
    case BIRTH_PARENT = 2;
    case ADOPTED_PARENT = 3;
    case STEPPARENT = 4;
    case PARENT_IN_LAW = 5;
}
