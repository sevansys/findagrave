<?php

namespace App\DTO\Cemetery;

class CemeteryWebsiteDTO
{
    public function __construct(
        public string $url,
        public string $text,
    ) {}
}
