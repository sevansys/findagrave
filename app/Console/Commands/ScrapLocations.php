<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Jobs\Scraper\LocationScrapJob;

class ScrapLocations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:scrap-locations {id} {root_url?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $source_id = intval($this->argument('id'));

        LocationScrapJob::dispatchSync(
            $source_id,
            $this->argument('root_url')
        );
    }
}
