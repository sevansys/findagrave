<?php

namespace App\DTO\Cemetery;

use App\Enums\EnumScrapStatus;

class CemeteryDTO
{
    public function __construct(
        public string $src,
        public string $name,
        public array $photos = [],
        public ?int $source_id = null,
        public ?string $address = null,
        public ?array $alt_name = null,
        public ?int $location_id = null,
        public ?float $latitude = null,
        public ?float $longitude = null,
        public ?string $search_url = null,
        public ?string $description = null,
        public ?CemeteryPhoneDTO $phone = null,
        public ?CemeteryWebsiteDTO $website = null,
        public ?EnumScrapStatus $scrap_status = null,
    ) {}
}
