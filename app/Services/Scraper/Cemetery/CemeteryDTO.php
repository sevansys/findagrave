<?php

namespace App\Services\Scraper\Cemetery;

class CemeteryDTO
{
    public function __construct(
        public string $src,
        public string $name,
        public array $photos = [],
        public ?int $source_id = null,
        public ?string $address = null,
        public ?array $coordinates = null,
        public ?string $description = null,
        public ?CemeteryPhoneDTO $phone = null,
        public ?CemeteryWebsiteDTO $website = null,
    ) {}
}
