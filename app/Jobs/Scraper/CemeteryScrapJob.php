<?php

namespace App\Jobs\Scraper;

use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\Cemetery;
use App\Repositories\Cemetery\CemeteryRepository;
use App\Services\Scraper\Cemetery\CemeteryScraper;

class CemeteryScrapJob implements ShouldQueue
{
    use Queueable;

    private ?Cemetery $cemetery;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly int $id,
        private readonly bool $continue_scrap = false,
    ) {}

    /**
     * Execute the job.
     */
    public function handle(CemeteryRepository $repository): void
    {
        $this->cemetery = $repository->findById($this->id);

        if (!$this->cemetery) {
            return;
        }

        $repository->markAsScraping($this->cemetery);

        $cemeteryDTO = (new CemeteryScraper($this->cemetery->src))->start();

        $repository->putScraped($this->cemetery, $cemeteryDTO);

//        if ($this->continue_scrap) {
//            dispatch(function () {
//                Artisan::call('app:scrap-next-cemetery');
//            })->delay(now()->addSeconds(10));
//        }
    }

    public function fail($exception, CemeteryRepository $cemeteryRepository)
    {
        report($exception);
        $cemeteryRepository->markAsScrapFail($this->cemetery);
    }
}
