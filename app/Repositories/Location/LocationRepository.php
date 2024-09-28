<?php

namespace App\Repositories\Location;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

use App\Models\Location;
use App\Enums\EnumLocation;
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
     * @return int
     */
    public function insertScraped(array $data, ?Location $parent): int
    {
        $data = array_map(function (LocationDTO $location) use ($parent) {
            $item = $this->toRow($location);
            $item['scrap_status'] = EnumScrapStatus::NEED_SCRAPING;
            $item["created_at"] = $item["updated_at"] = Carbon::now()->toAtomString();

            if ($parent) {
                $item['parent_id'] = $parent->id;
            }

            return $item;
        }, $data);

        return Location::insertOrIgnore($data);
    }

    public function findById(int $id): ?Location
    {
        return $this->fromWhole(Location::query())->find($id);
    }

    public function create(LocationDTO $location): Location
    {
        $row = $this->toRow($location);
        return Location::query()->create($row);
    }

    public function nextForScrap(): ?Location
    {
        return $this->fromWhole(Location::query())
            ->where('scrap_status', EnumScrapStatus::NEED_SCRAPING->value)
            ->first();
    }

    public function toDTO(Location $location): LocationDTO
    {
        return new LocationDTO(
            src: $location->src,
            text: $location->text,
            parent_id: $location->parent_id,
            type: $location->type,
            scrap_status: $location->scrap_status,
        );
    }

    public function toRow(LocationDTO $location): array
    {
        return [
            'src' => $location->src,
            'text' => $location->text,
            'type' => $location->type,
            'parent_id' => $location->parent_id,
            'scrap_status' => $location->scrap_status,
        ];
    }

    public function childrenForBrowse(?int $id): ?Location
    {
        if (empty($id)) {
            return $this->makeContinentLocations();
        }

        return Location::query()->where('id', $id)->with(['children', 'cemeteries', 'parents'])->first([
            'id',
            'type',
            'text',
            'parent_id',
        ]);
    }

    private function makeContinentLocations(): Location
    {
        $location = new Location();
        $location->id = null;
        $location->text = null;
        $location->type = null;
        $location->parents = [];

        $location->setRelation(
            'children',
            Location::query()->where('parent_id', null)->get([
                'id',
                'text',
            ])
        );
        return $location;
    }

    /**
     * @param int|null $id
     * @return Collection<Location>
     */
    public function browseLocation(?int $id): Collection
    {
        return Location::query()
            ->where('parent_id', $id)
            ->get([
                'id',
                'text',
                'type',
            ]);
    }

    public function autoComplete(?string $like, array|null $types = null): ?Collection
    {
        if (is_null($like)) {
            return null;
        }

        $query = Location::where(function(Builder $query) use ($like) {
            $query->whereRaw('SOUNDEX(text) = SOUNDEX(?)', [$like]);
            $query->orWhereLike('text', 'like', "%$like%");
        });

        $types = $this->toAutoCompleteTypesRow($types);
        if ($types) {
            $query->whereIn('type', array_map(
                fn(EnumLocation $type) => $type->value, $types)
            );
        }

        return $query
            ->with('parents')
            ->get(['id', 'text', 'parent_id']);
    }

    private function toAutoCompleteTypesRow(EnumLocation|array|null $types = null): ?array
    {
        if (!$types) {
            return null;
        }

        if (!is_array($types)) {
            $types = [$types];
        }

        return $types;
    }
}
