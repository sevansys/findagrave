<?php

namespace App\Enums\Relationship;

enum EnumGrandparentRelationship: int
{
    case GRANDPARENT = 1;
    case GREAT_GRANDPARENT = 2;
}
