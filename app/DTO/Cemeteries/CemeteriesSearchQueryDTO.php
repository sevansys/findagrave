<?php

namespace App\DTO\Cemeteries;

class CemeteriesSearchQueryDTO {
    public function __construct(
        public int $page,
        public string $cemetery,
        public int $location_id,
    ) {}
}
