<?php

namespace App\Services\Scraper\Media;

use App\Enums\EnumMedia;

class MediaDTO
{
    public function __construct(
        public string $url,
        public int $added_by,
        public EnumMedia $type,
        public string $added_at,
        public ?string $caption,
    ) {}
}
