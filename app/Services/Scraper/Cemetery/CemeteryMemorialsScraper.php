<?php

namespace App\Services\Scraper\Cemetery;

use App\Services\Scraper\Scraper;

class CemeteryMemorialsScraper extends Scraper
{
    private array $items = [];

    public function __construct(
        private readonly string $search_url,
        private readonly int $page
    ) {}

    public function getUrl(): string
    {
        return sprintf('%s?page=%d', $this->search_url, $this->page);
    }

    public function start(): array
    {
        $this->scrap($this->getUrl());

        return $this
            ->produceItems()
            ->items;
    }

    private function produceItems(): self
    {
        $items = $this->crawler->filter('.memorial-item');

        return $this;
    }
}
