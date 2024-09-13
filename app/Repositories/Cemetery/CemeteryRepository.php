<?php

namespace App\Repositories\Cemetery;

use App\DTO\Media\MediaDTO;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Collection;

use App\Models\Cemetery;
use App\Models\Location;
use App\Enums\EnumScrapStatus;
use App\Repositories\Scrapeable;
use App\DTO\Cemetery\CemeteryDTO;
use App\DTO\Cemetery\CemeteryPhoneDTO;
use App\DTO\Cemetery\CemeteryWebsiteDTO;

class CemeteryRepository extends Scrapeable\ScrapeableRepository
{
    /**
     * Inserting parsed data by location
     *
     * @param Location $location
     * @param array<CemeteryDTO> $data
     * @return Collection<Cemetery>
     */
    public function insertScraped(Location $location, array $data): Collection
    {
        $data = array_map(function (CemeteryDTO $cemetery) {
            $item = $this->toRow($cemetery);
            $item['status'] = EnumScrapStatus::NEED_SCRAPING;
            $item['created_at'] = $item['updated_at'] = Carbon::now()->toAtomString();

            return $item;
        }, $data);

        return $location->cemeteries()->createMany($data);
    }

    public function putScraped(Cemetery $cemetery, CemeteryDTO $dto): Cemetery
    {
        $data = array_merge(
            $this->toPutRow($dto),
            [
                'status' => EnumScrapStatus::SCRAPED
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

    public function nextForScrap(): ?Cemetery
    {
        return Cemetery::query()
            ->where('status', EnumScrapStatus::NEED_SCRAPING)
            ->first();
    }

    public function nextForScrapId(): ?int
    {
        return Cemetery::query()
            ->where('status', EnumScrapStatus::NEED_SCRAPING)
            ->first(['id'])
            ?->id;
    }

    public function findById(int $id): ?Cemetery
    {
        return Cemetery::query()->find($id);
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
                'status' => $cemetery->status,
                'location_id' => $cemetery->location_id,
            ]
        );
    }

    public function toPutRow(CemeteryDTO $cemetery): array
    {
        return [
            'name' => $cemetery->name,
            'address' => $cemetery->address,
            'alt_name' => $cemetery->alt_name,
            'coordinates' => $cemetery->coordinates,
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
}
