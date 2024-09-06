<?php

namespace App\Enums\Relationship;

enum EnumSiblingRelationship: int
{
    case SIBLING = 1;
    case ADOPTED_SIBLING = 2;
    case STEPSIBLING = 3;
    case SIBLING_IN_LAW = 4;
}
