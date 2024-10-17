<?php

namespace App\Http\Controllers\Json\Cemeteries\Search;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\Numeric;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\Sometimes;
use Spatie\LaravelData\Attributes\Validation\StringType;

class CemeteriesSearchRequest extends Data
{
    public function __construct(
        #[Sometimes]
        #[StringType]
        public ?string $cemetery = null,

        #[Required]
        #[Exists('locations', 'id')]
        public int $location_id,

        #[Numeric]
        #[Sometimes]
        public ?int $page = null,
    ) {}

    public static function attributes(): array
    {
        return [
            'cemetery' => 'Cemetery Name',
            'location_id' => 'Cemetery Location'
        ];
    }

    public static function messages(): array
    {
        return [
            'location_id.*' => 'Please select the Cemetery Location from the list.'
        ];
    }
}
