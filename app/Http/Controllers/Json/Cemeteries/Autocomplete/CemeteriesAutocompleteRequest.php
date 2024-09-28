<?php

namespace App\Http\Controllers\Json\Cemeteries\Autocomplete;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Sometimes;
use Spatie\LaravelData\Attributes\Validation\StringType;

class CemeteriesAutocompleteRequest extends Data
{
    public function __construct(
        #[Min(3)]
        #[Sometimes]
        #[StringType]
        public ?string $like = null,
    ) {}
}
