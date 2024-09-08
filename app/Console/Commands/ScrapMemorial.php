<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Jobs\Scraper\MemorialScrapJob;

class ScrapMemorial extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:scrap-memorial {src}';

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
        MemorialScrapJob::dispatch($this->argument('src'));
    }
}
