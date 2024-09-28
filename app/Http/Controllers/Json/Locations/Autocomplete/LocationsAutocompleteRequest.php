<?php

namespace App\Http\Controllers\Json\Locations\Autocomplete;

use Spatie\LaravelData\Attributes\Validation\ArrayType;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Enum;
use Spatie\LaravelData\Attributes\Validation\Sometimes;
use Spatie\LaravelData\Attributes\Validation\StringType;

use App\Enums\EnumLocation;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class LocationsAutocompleteRequest extends Data
{
    public function __construct(
        #[Min(3)]
        #[Sometimes]
        #[StringType]
        public ?string $like = null,

        #[Sometimes]
        #[ArrayType]
        public array|null $types = null,
    ) {}

    public static function rules(ValidationContext $context): array
    {
        return [
            'types' => [
                'sometimes',
                function($attribute, $value, $fail) {
                    if (is_array($value)) {
                        foreach ($value as $val) {
                            if (!EnumLocation::tryFrom($val)) {
                                $fail("The $attribute contains invalid value: $val");
                            }
                        }
                    }

                    return true;
                }
            ],
        ];
    }
}
