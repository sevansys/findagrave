<?php

namespace App\DTO\Location;

use App\Enums\EnumLocation;
use App\Enums\EnumScrapStatus;

class LocationDTO
{
    public function __construct(
        public string $src,
        public string $text,
        public ?int $parent_id = null,
        public ?EnumLocation $type = null,
        public ?EnumScrapStatus $status = null,
    ) {}
}
