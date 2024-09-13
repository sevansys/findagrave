<?php

namespace App\Services\Scraper\Cemetery;

use App\Services\Scraper\Memorial\MemorialScraper;
use Illuminate\Support\Facades\Log;
use Throwable;

use Symfony\Component\DomCrawler\Crawler;

use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;

use App\Services\Scraper\Scraper;
use App\Jobs\Scraper\MemorialScrapJob;

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

    /**
     * @throws Throwable
     */
    public function start(): array
    {
        $this->scrap($this->getUrl());

        return $this
            ->produceItems()
            ->items;
    }

    /**
     * @throws Throwable
     */
    private function produceItems(): self
    {
        $items = $this->crawler->filter('.memorial-item > a');

        $jobs = [];
        foreach ($items as $item) {
            $item = new Crawler($item);
            $href = $item->attr('href');

            if (empty($href)) {
                continue;
            }

            $jobs[] = new MemorialScrapJob($href);
        }

        Bus::batch($jobs)
            ->onConnection("redis")
            ->onQueue('imports')
            ->then(function (Batch $batch) {
                dd($batch);
            })
            ->dispatch();

        return $this;
    }
}
