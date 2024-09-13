<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Jobs\Scraper\CemeteryScrapJob;

class ScrapCemetery extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:scrap-cemetery {id}';

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
        CemeteryScrapJob::dispatch($this->argument('src'));
    }
}
