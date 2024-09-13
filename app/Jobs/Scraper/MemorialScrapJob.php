<?php

namespace App\Jobs\Scraper;

use Illuminate\Bus\Batchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Services\Scraper\Memorial\MemorialScraper;

class MemorialScrapJob implements ShouldQueue
{
    use Queueable, Batchable;

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
        $memorial = (new MemorialScraper($this->src))->start();
        dd($memorial);
    }
}
