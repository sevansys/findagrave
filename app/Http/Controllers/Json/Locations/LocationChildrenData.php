<?php

namespace App\Http\Controllers\Json\Locations;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation\Sometimes;

class LocationChildrenData extends Data
{
    public function __construct(
        #[Sometimes]
        public ?int $parentId = null,
    ) {}
}
