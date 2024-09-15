<?php

namespace App\Enums;

enum EnumSearchMemorialType: string
{
    case FAMOUS = 'type-famous';
    case VETERAN = 'type-veteran';
    case CENOTAPH = 'type-cenotaph';
    case MONUMENT = 'type-monument';
    case NOT_BURIED_CEMETERY = 'type-not-buried-cemetery';
}
