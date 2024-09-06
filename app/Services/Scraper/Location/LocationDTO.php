<?php

namespace App\Services\Scraper\Location;

use App\Enums\EnumLocation;

class LocationDTO
{
    public function __construct(
        public string $src,
        public string $text,
        public string $source_id,
        public ?EnumLocation $type,
        public array $items = [],
    ) {}
}
