<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Jobs\Scraper\LocationScrapJob;
use App\Repositories\Location\LocationRepository;

class ScrapLocations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:scrap-locations {id} {continue_scrap?} {root_url?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(LocationRepository $repository): void
    {
        $source_id = intval($this->argument('id'));
        $location = $repository->findById($source_id);

        LocationScrapJob::dispatchSync(
            $location?->id,
            !!$this->argument('continue_scrap'),
            $this->argument('root_url'),
        );
    }
}
