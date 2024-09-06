<?php

namespace App\Enums;

enum EnumPersonRelation: int
{
    case SPOUSE_PARTNER = 1;
    case CHILD = 2;
    case PARENT = 3;
    case GRANDCHILD = 4;
    case GRANDPARENT = 5;
    case SIBLING = 6;
    case AUNT_UNCLE = 7;
    case NIECE_NEPHEW = 8;
    case FIRST_COUSIN = 9;
}
