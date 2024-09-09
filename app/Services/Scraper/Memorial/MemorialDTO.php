<?php

namespace App\Services\Scraper\Memorial;

use App\Enums\EnumBurial;
use App\Enums\EnumSuffix;
use App\Enums\EnumPersonGender;

class MemorialDTO
{
    public function __construct(
        public string $src,
        public array $photos = [],
        public ?string $bio = null,
        public array $parents = [],
        public array $spouses = [],
        public ?string $plot = null,
        public ?string $birth = null,
        public ?string $death = null,
        public ?string $prefix = null,
        public ?int $source_id = null,
        public ?int $person_id = null,
        public float $famous_rate = 0,
        public array $coordinates = [],
        public bool $is_famous = false,
        public ?string $nickname = null,
        public bool $is_veteran = false,
        public bool $is_memorial = false,
        public bool $is_cenotaph = false,
        public ?string $last_name = null,
        public ?EnumBurial $burial = null,
        public ?EnumSuffix $suffix = null,
        public int $famous_rate_votes = 0,
        public ?string $created_at = null,
        public ?string $first_name = null,
        public ?string $maiden_name = null,
        public ?string $middle_name = null,
        public ?string $inscription = null,
        public ?string $original_name = null,
        public bool $is_still_living = false,
        public ?string $grave_details = null,
        public ?string $burial_derails = null,
        public ?string $birth_location = null,
        public ?string $death_location = null,
        public ?int $cemetery_source_id = null,
        public ?EnumPersonGender $gender = null,
        public ?int $bio_author_source_id = null,
        public ?int $contributor_source_id = null,
    ) {}
}
