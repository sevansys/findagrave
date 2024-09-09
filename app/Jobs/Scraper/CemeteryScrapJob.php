<?php

namespace App\Jobs\Scraper;

use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Services\Scraper\Cemetery\CemeteryScraper;

class CemeteryScrapJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly string $src
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $cemetery = (new CemeteryScraper($this->src))->start();
        dd($cemetery);
    }
}
