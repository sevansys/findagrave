<?php

namespace App\Repositories\Cemetery;

use App\DTO\Cemeteries\CemeteriesSearchQueryDTO;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

use App\Models\Cemetery;
use App\Models\Location;
use App\DTO\Media\MediaDTO;
use App\Enums\EnumScrapStatus;
use App\Repositories\Scrapeable;
use App\DTO\Cemetery\CemeteryDTO;
use App\DTO\Cemetery\CemeteryPhoneDTO;
use App\DTO\Cemetery\CemeteryWebsiteDTO;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Pagination\LengthAwarePaginator;

class CemeteryRepository extends Scrapeable\ScrapeableRepository
{
    /**
     * Inserting parsed data by location
     *
     * @param Location $location
     * @param array<CemeteryDTO> $data
     * @return int
     */
    public function insertScraped(Location $location, array $data): int
    {
        $data = array_map(function (CemeteryDTO $cemetery) use ($location) {
            $item = $this->toRow($cemetery);
            $item['location_id'] = $location->id;
            $item['scrap_status'] = EnumScrapStatus::NEED_SCRAPING;
            $item['created_at'] = $item['updated_at'] = Carbon::now()->toAtomString();

            return $item;
        }, $data);

        return Cemetery::insertOrIgnore($data);
    }

    public function putScraped(Cemetery $cemetery, CemeteryDTO $dto): Cemetery
    {
        $data = array_merge(
            $this->toPutRow($dto),
            [
                'scrap_status' => EnumScrapStatus::SCRAPED
            ]
        );

        $cemetery->update($data);
        $this->putPhotos($cemetery, $dto);

        return $cemetery;
    }

    public function putPhotos(Cemetery $cemetery, CemeteryDTO $cemeteryDTO): void
    {
        if (empty($cemeteryDTO->photos)) {
            return;
        }

        $photos = array_map(function(MediaDTO $media) {
            return [
                'src' => $media->src,
                'type' => $media->type,
                'width' => $media->width,
                'height' => $media->height,
                'source_id' => $media->source_id,
                'contributor_id' => $media->contributor_id,
            ];
        }, $cemeteryDTO->photos);

        $cemetery->media()->createMany($photos);
    }

    public function nextForScrapId(): ?int
    {
        return $this->fromWhole(Cemetery::query())
            ->where('scrap_status', EnumScrapStatus::NEED_SCRAPING)
            ->first(['id'])
            ?->id;
    }

    public function findById(int $id): ?Cemetery
    {
        return $this->fromWhole(Cemetery::query())->find($id);
    }

    /**
     * Converting dto to array
     *
     * @param CemeteryDTO $cemetery
     * @return array
     */
    public function toRow(CemeteryDTO $cemetery): array
    {
        return array_merge(
            $this->toPutRow($cemetery),
            [
                'src' => $cemetery->src,
                'location_id' => $cemetery->location_id,
                'scrap_status' => $cemetery->scrap_status,
            ]
        );
    }

    public function toPutRow(CemeteryDTO $cemetery): array
    {
        return [
            'name' => $cemetery->name,
            'address' => $cemetery->address,
            'alt_name' => $cemetery->alt_name,
            'latitude' => $cemetery->latitude,
            'longitude' => $cemetery->longitude,
            'description' => $cemetery->description,
            'phone' => $this->toPhoneRow($cemetery->phone),
            'website' => $this->toWebsiteRow($cemetery->website),
        ];
    }

    /**
     * Converting phone dto to array
     *
     * @param CemeteryPhoneDTO|null $phone
     * @return array|null
     */
    public function toPhoneRow(?CemeteryPhoneDTO $phone): ?array
    {
        if (!$phone) {
            return null;
        }

        return [
            'text' => $phone->text,
            'href' => $phone->href,
        ];
    }

    /**
     * Converting website dto to array
     *
     * @param CemeteryWebsiteDTO|null $website
     * @return array|null
     */
    public function toWebsiteRow(?CemeteryWebsiteDTO $website): ?array
    {
        if (!$website) {
            return null;
        }

        return [
            'url' => $website->url,
            'text' => $website->text,
        ];
    }

    public function autoComplete(?string $like): ?Collection
    {
        if (is_null($like)) {
            return null;
        }

        return Cemetery::query()
            ->whereRaw('SOUNDEX(name) = SOUNDEX(?)', [$like])
            ->orWhere('name', 'like', "%$like%")
            ->get(['id', 'name']);
    }

    public function search(CemeteriesSearchQueryDTO $request): LengthAwarePaginator
    {
        return  Cemetery::query()
            ->with('media', fn(MorphMany $morphMany) =>
                $morphMany
                    ->select('src', 'owner_id', 'owner_type')
                    ->limit(1)
            )
            ->whereHas('location', function(Builder $belongsTo) use ($request) {
                $belongsTo->where('id', $request->location_id);
            })
            ->where(function(Builder $query) use ($request) {
                $query->whereRaw('SOUNDEX(name) = SOUNDEX(?)', [$request->cemetery])
                    ->orWhere('name', 'like', "%$request->cemetery%");
            })
            ->paginate(15 * $request->page, [
                'id',
                'name',
                'address',
                'alt_name',
                'location_id',
            ]);
    }
}
