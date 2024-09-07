<?php

namespace App\Console\Commands;

use App\Jobs\Scraper\CemeteryScrapJob;
use Illuminate\Console\Command;

class ScrapCemetery extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:scrap-cemetery';

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
        CemeteryScrapJob::dispatch('/cemetery/639018/cimetière-du-père-lachaise');
            //
    }
}
