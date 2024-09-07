<?php

namespace App\Services\Scraper\Media;

class MediaAuthorDTO
{
    public function __construct(
        public int $id,
        public string $src,
        public string $fullName,
    ) {}
}
