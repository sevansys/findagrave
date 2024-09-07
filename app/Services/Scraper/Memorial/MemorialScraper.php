<?php

namespace App\Services\Scraper\Memorial;

use App\Services\Scraper\Scraper;

class MemorialScraper extends Scraper
{
    public function __construct(
        public string $src,
    ) {}

    public function start()
    {
        $response = $this->scrap($this->src);
        dd($response);
    }
}
