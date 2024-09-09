<?php

namespace App\Enums;

enum EnumSuffix: string
{
    case JR = "Jr";
    case Sr = "Sr";
    case FIRST = "I";
    case SECOND = "II";
    case THIRD = "III";
    case FOURTH = "IV";
    case FIFTH = "V";
    case SIXTH = "VI";

    public static function map(): array
    {
        return array_reduce(self::cases(), function (array $payload, EnumSuffix $enum) {
            $key = $enum->value;
            if (in_array($key, [self::Sr->value, self::JR->value])) {
                $key .= ".";
            }

            $payload[$key] = $enum;

            return $payload;
        }, []);
    }
}
