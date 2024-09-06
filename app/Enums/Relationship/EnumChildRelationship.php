<?php

namespace App\Enums\Relationship;

enum EnumChildRelationship: int
{
    case CHILD = 1;
    case BIRTH_CHILD = 2;
    case ADOPTED_CHILD = 3;
    case STEPCHILD = 4;
    case CHILD_IN_LAW = 5;
}
