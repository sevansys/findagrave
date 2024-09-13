<?php

namespace App\DTO\Media;

use App\Enums\EnumMedia;

class MediaDTO
{
    public function __construct(
        public string $src,
        public ?int $width,
        public ?int $height,
        public ?int $source_id,
        public ?string $caption,
        public ?EnumMedia $type,
        public ?string $created_at,
        public ?int $contributor_id,
    ) {}
}
