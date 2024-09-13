<?php

namespace App\DTO\Cemetery;

class CemeteryPhoneDTO
{
    public function __construct(
        public string $href,
        public string $text,
    ) {}
}
