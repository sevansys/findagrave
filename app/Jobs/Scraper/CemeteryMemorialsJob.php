<?php

namespace App\Jobs\Scraper;

use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Services\Scraper\Cemetery\CemeteryMemorialsScraper;
use Throwable;

class CemeteryMemorialsJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly string $src,
        private readonly int $page,
    ) {}

    /**
     * Execute the job.
     * @throws Throwable
     */
    public function handle(): void
    {
        $memorials = (new CemeteryMemorialsScraper($this->src, $this->page))->start();

//        if (!empty($memorials)) {
//            CemeteryMemorialsJob::dispatch($this->src, $this->page + 1)->delay(now()->addSeconds(30));
//        }
    }
}
