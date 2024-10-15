<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Repositories\Location\LocationRepository;

class ScrapNextLocation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:scrap-next-location';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scraping the next location that should be scraped';

    /**
     * Execute the console command.
     */
    public function handle(LocationRepository $repository): void
    {
        $location = $repository->nextForScrap();

        if ($location) {
            $repository->markAsScraping($location);
        }

        $this->call('app:scrap-locations', [
            'id' => $location?->id,
        ]);
    }
}
