<?php

namespace App\DTO\Cemetery;

use App\Enums\EnumScrapStatus;

class CemeteryDTO
{
    public function __construct(
        public string $src,
        public string $name,
        public array $photos = [],
        public ?string $address = null,
        public ?array $alt_name = null,
        public ?int $location_id = null,
        public ?array $coordinates = null,
        public ?string $description = null,
        public ?CemeteryPhoneDTO $phone = null,
        public ?EnumScrapStatus $status = null,
        public ?CemeteryWebsiteDTO $website = null,
    ) {}
}