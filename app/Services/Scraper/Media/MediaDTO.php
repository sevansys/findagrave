<?php

namespace App\Services\Scraper\Media;

use App\Enums\EnumMedia;

class MediaDTO
{
    public function __construct(
        public string $src,
        public ?EnumMedia $type,
        public ?string $caption,
        public ?string $added_at,
        public ?MediaAuthorDTO $added_by,
    ) {}
}
