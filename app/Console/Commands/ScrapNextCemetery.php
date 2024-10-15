<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Jobs\Scraper\CemeteryScrapJob;
use App\Repositories\Cemetery\CemeteryRepository;

class ScrapNextCemetery extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:scrap-next-cemetery {country_id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(CemeteryRepository $repository): void
    {
        $nextId = $repository->nextForScrapId();

        if (!$nextId) {
            return;
        }

        CemeteryScrapJob::dispatchSync(
            $nextId,
            true
        );
    }
}
