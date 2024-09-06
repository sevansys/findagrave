<?php

namespace App\Enums\Relationship;

enum EnumGrandchildRelationship: int
{
    case GRANDCHILD = 1;
    case GREAT_GRANDCHILD = 2;
}
