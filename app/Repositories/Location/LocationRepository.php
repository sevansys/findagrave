<?php

namespace App\Repositories\Location;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Collection;

use App\Models\Location;
use App\Enums\EnumScrapStatus;
use App\DTO\Location\LocationDTO;
use App\Repositories\Scrapeable\ScrapeableRepository;

class LocationRepository extends ScrapeableRepository
{
    /**
     * Insert parsed locations to database
     *
     * @param array $data
     * @param Location|null $parent
     * @return Collection<Location>
     */
    public function insertScraped(array $data, ?Location $parent): Collection
    {
        $data = array_map(function (LocationDTO $location) {
            $item = $this->toRow($location);
            $item['status'] = EnumScrapStatus::NEED_SCRAPING;
            $item["created_at"] = $item["updated_at"] = Carbon::now()->toAtomString();
            return $item;
        }, $data);

        if (!$parent) {
            $parent = new Location();
        }

        return $parent->children()->createMany($data);
    }

    public function findById(int $id): ?Location
    {
        return Location::query()->find($id);
    }

    public function findBySource(string $src): ?Location
    {
        return Location::query()
            ->where('source_id', $src)
            ->first();
    }

    public function create(LocationDTO $location): Location
    {
        $row = $this->toRow($location);
        return Location::query()->create($row);
    }

    public function nextForScrap(): ?Location
    {
        return Location::query()
            ->where('status', EnumScrapStatus::NEED_SCRAPING->value)
            ->first();
    }

    public function toDTO(Location $location): LocationDTO
    {
        return new LocationDTO(
            src: $location->src,
            text: $location->text,
            parent_id: $location->parent_id,
            type: $location->type,
            status: $location->status,
        );
    }

    public function toRow(LocationDTO $location): array
    {
        return [
            'src' => $location->src,
            'text' => $location->text,
            'type' => $location->type,
            'status' => $location->status,
            'parent_id' => $location->parent_id,
        ];
    }
}
