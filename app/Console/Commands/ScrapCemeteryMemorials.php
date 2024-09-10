<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Jobs\Scraper\CemeteryMemorialsJob;

class ScrapCemeteryMemorials extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:scrap-cemetery-memorials {src} {page}';

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
        $src = $this->argument('src');
        $page = intval($this->argument('page'));

        CemeteryMemorialsJob::dispatch($src, $page);
    }
}
