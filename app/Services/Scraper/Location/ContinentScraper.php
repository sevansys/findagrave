<?php

namespace App\Services\Scraper\Location;

use Symfony\Component\DomCrawler\Crawler;

class ContinentScraper extends LocationScraper
{
    public function start(?string $locationId = null): array
    {
        $response = $this->scrap($this->path);

        $data = [];
        foreach ($this->fetchItems($response) as $node) {
            if (!$node) {
                continue;
            }

            $data[] = $this->produceItem(new Crawler($node));
        }

        return $data;
    }
}
