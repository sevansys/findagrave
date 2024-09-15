<?php

namespace App\Jobs\Scraper;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\Location;
use App\Repositories\Cemetery\CemeteryRepository;
use App\Repositories\Location\LocationRepository;
use App\Services\Scraper\Location\LocationScraper;

class LocationScrapJob implements ShouldQueue
{
    use Queueable;

    private ?Location $location = null;

    const string BROWSE_HEAD_URL = '/cemetery-browse';

    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly ?string $id = null,
        private readonly bool $continue_scrap = false,
        private readonly ?string $root_url = null
    ) {}

    /**
     * Execute the job.
     */
    public function handle(LocationRepository $locationRepository, CemeteryRepository $cemeteryRepository): void
    {
        if ($this->id) {
            $this->location = $locationRepository->findById($this->id);
        }

        [$locations, $cemeteries] = (new LocationScraper(
            $this->getSearchUrl()
        ))->start();

        if (!empty($locations)) {
            $locationRepository->insertScraped($locations, $this->location);
        }

        if (!empty($cemeteries) && !!$this->location) {
            $cemeteryRepository->insertScraped($this->location, $cemeteries);
        }

        if ($this->location) {
            $locationRepository->markAsScraped($this->location);
        }

        if ($this->continue_scrap) {
            dispatch(function () {
                Artisan::call('app:scrap-next-location');
            })->delay(now()->addSeconds(12));
        }
    }

    private function getSearchUrl(): string
    {
        return $this->location?->src ?? $this->root_url ?? self::BROWSE_HEAD_URL;
    }

    public function fail($exception, LocationRepository $repository): void
    {
        report($exception);
        $repository->markAsScrapFail($this->location);
    }
}
