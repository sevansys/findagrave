<?php

namespace App\Jobs\Scraper;

use App\Services\Scraper\Cemetery\CemeteryScraper;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

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
