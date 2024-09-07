<?php

namespace App\Services\Scraper\Cemetery;

class CemeteryWebsiteDTO
{
    public function __construct(
        public string $url,
        public string $text,
    ) {}
}
