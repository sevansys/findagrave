<?php

namespace App\Services\Scraper\Cemetery;

class CemeteryDTO
{
    public function __construct(
        public string $src,
        public string $name,
        public int $source_id,
        public ?string $address,
        public ?string $phone,
        public ?array $coordinates,
        public ?string $description,
    )
    {
    }
}
