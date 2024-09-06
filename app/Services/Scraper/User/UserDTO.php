<?php

namespace App\Services\Scraper\User;

class UserDTO
{
    public function __construct(
        public string $name,
        public int $source_id,
        public ?string $avatar,
        public ?string $bio,
        public ?array $followers,
    ) {}
}
