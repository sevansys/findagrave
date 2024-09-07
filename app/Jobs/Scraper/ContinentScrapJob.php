<?php

namespace App\Jobs\Scraper;

use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Services\Scraper\Location\LocationScraper;

class ContinentScrapJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly string $locationId
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        (new LocationScraper())->start($this->locationId);
    }
}
