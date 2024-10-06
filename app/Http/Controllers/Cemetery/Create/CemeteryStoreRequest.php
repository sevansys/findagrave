<?php

namespace App\Http\Controllers\Cemetery\Create;

use Illuminate\Validation\Rule;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\ArrayType;
use Spatie\LaravelData\Attributes\Validation\Sometimes;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Support\Validation\ValidationContext;

use App\Enums\EnumVisibility;

class CemeteryStoreRequest extends Data
{
    public function __construct(
        #[Required]
        #[ArrayType]
        public array $name,

        #[Required]
        #[Exists('locations', 'id')]
        public int $location_id,

        #[Sometimes]
        public ?string $address = null,

        #[Sometimes]
        public ?string $latitude = null,


        #[Sometimes]
        public ?string $longitude = null,

        #[ArrayType]
        #[Sometimes]
        public ?array $additional_location = null,

        #[Sometimes]
        #[StringType]
        public ?string $description = null,

        #[Sometimes]
        public ?array $more = null,
    ) {}

    public static function rules(ValidationContext $context): array
    {
        return [
            'additional_location.*' => [
                'sometimes',
                'exists:locations,id',
            ],
            'more.website' => 'sometimes|nullable|url',
            'more.email' => 'sometimes|nullable|email|string',
            'more.phone' => 'sometimes|nullable|string|max:255',
            'more.office_address' => 'sometimes|nullable|string',
            'more.additional_info' => 'sometimes|nullable|string',
            'more.visibility' => [
                'nullable',
                'sometimes',
                Rule::in(array_map(fn(EnumVisibility $visibility) => $visibility->value, EnumVisibility::cases()))
            ],
        ];
    }

    public static function messages(): array
    {
        return [
            'more.phone' => 'The phone must be a string.',
            'more.website' => 'The website must be a valid URL.',
            'location_id' => 'Please select location from the list.',
            'more.email' => 'The email must be a valid email address.',
            'more.visibility' => 'The visibility must be a valid value.',
            'more.office_address' => 'The office address must be a string.',
            'more.additional_info' => 'The additional info must be a string.',
            'additional_location.*' => 'The selected additional locations are invalid.',
        ];
    }
}
