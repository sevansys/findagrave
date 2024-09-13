<?php

namespace App\Repositories\Scrapeable;

use Illuminate\Database\Eloquent\Model;

use App\Enums\EnumScrapStatus;

class ScrapeableRepository
{
    public function markAsScrapFail(Model $model): bool
    {
        return $model->update([
            'status' => EnumScrapStatus::SCRAP_FAILED->value,
        ]);
    }

    public function markAsScraped(Model $model): bool
    {
        return $model->update([
            'status' => EnumScrapStatus::SCRAPED->value,
        ]);
    }

    public function markAsScraping(Model $model): bool
    {
        return $model->update([
            'status' => EnumScrapStatus::SCRAPING->value,
        ]);
    }
}
