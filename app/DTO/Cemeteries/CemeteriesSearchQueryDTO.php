<?php

namespace App\DTO\Cemeteries;

class CemeteriesSearchQueryDTO {
    public function __construct(
        public int $page,
        public int $location_id,
        public ?string $cemetery = null,
    ) {}
}
