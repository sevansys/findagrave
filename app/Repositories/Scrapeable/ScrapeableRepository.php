<?php

namespace App\Repositories\Scrapeable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

use App\Enums\EnumScrapStatus;
use App\Models\Scopes\ScrapedRecord;

class ScrapeableRepository
{
    public function markAsScrapFail(Model $model): bool
    {
        return $model->update([
            'scrap_status' => EnumScrapStatus::SCRAP_FAILED->value,
        ]);
    }

    public function markAsScraped(Model $model): bool
    {
        return $model->update([
            'scrap_status' => EnumScrapStatus::SCRAPED->value,
        ]);
    }

    public function markAsScraping(Model $model): bool
    {
        return $model->update([
            'scrap_status' => EnumScrapStatus::SCRAPING->value,
        ]);
    }

    protected function fromWhole(Builder $builder): Builder
    {
        return $builder->withoutGlobalScope(ScrapedRecord::class);
    }
}
