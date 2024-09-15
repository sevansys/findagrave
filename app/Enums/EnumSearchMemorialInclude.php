<?php

namespace App\Enums;

enum EnumSearchMemorialInclude: string
{
    case TITLES = 'include-titles';
    case NICKNAME = 'include-nickname';
    case MAIDEN_NAME = 'include-maiden-name';
    case EXACT_NAME_SPELLING = 'include-exact-name-spelling';
    case SIMILAR_NAME_SPELLINGS = 'include-similar-name-spellings';
}
