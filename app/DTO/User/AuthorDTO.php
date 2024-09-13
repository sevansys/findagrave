<?php

namespace App\DTO\User;

class AuthorDTO
{
    public function __construct(
        public int $id,
        public string $src,
        public string $full_name,
    ) {}
}
