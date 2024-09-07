<?php

namespace App\Services\Scraper\Cemetery;

class CemeteryPhoneDTO
{
    public function __construct(
        public string $href,
        public string $text,
    ) {}
}
