<?php

namespace App\Enums;

enum EnumBurial: string
{
    case CREMATED = "Cremated";
    case ANIMAL_PET = "Animal/Pet";
    case LOST_AT_WAR = "Lost at War";
    case BURIED_LOST_SEA = "Buried or Lost at Sea";
    case BURIAL_DETAILS_UNKNOWN = "Burial Details Unknown";
    case DONATED_MEDICAL_SCIENCE = "Donated to Medical Science";

    public static function getType(string $value): ?self
    {
        foreach (self::cases() as $case) {
            if ($case->value === $value) {
                return $case;
            }
        }

        return null;
    }
}
