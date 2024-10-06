<?php

namespace App\Http\Controllers\Cemetery\Create;

use Illuminate\Support\Str;

use Baghunts\LaravelFastEndpoints\Attributes\Name;
use Baghunts\LaravelFastEndpoints\Attributes\Post;
use Baghunts\LaravelFastEndpoints\Endpoint\Endpoint;

use App\Enums\EnumVisibility;
use App\DTO\Cemetery\CemeteryDTO;
use App\DTO\Cemetery\CemeteryPhoneDTO;
use App\DTO\Cemetery\CemeteryWebsiteDTO;
use App\Repositories\Cemetery\CemeteryRepository;

#[Post('/cemeteries')]
#[Name('cemetery.store')]
class CemeteryStoreController extends Endpoint
{
    public function __invoke(
        CemeteryStoreRequest $request,
        CemeteryRepository $cemeteryRepository
    )
    {
        [$name, $alt_name] = $this->fetchNames($request->name);

        $dto = new CemeteryDTO(
            src: Str::uuid(),
            name: $name,
            email: $this->fetchMore($request, 'email'),
            address: $request->address,
            alt_name: $alt_name,
            latitude: $request->latitude,
            location_id: $request->location_id,
            longitude: $request->longitude,
            description: $request->description,
            office_address: $this->fetchMore($request, 'office_address'),
            additional_info: $this->fetchMore($request, 'additional_info'),
            phone: $this->createPhone($request),
            website: $this->createWebsite($request),
            additional_location: $request->additional_location,
            visibility: $this->getVisibility($request),
        );

        $cemetery = $cemeteryRepository->create($dto);

        return redirect()->to($cemetery->toAboutRoute());
    }

    private function getVisibility(CemeteryStoreRequest $request): EnumVisibility
    {
        $requestVisibility = $this->fetchMore($request, 'visibility');
        $tryEnum = EnumVisibility::tryFrom($requestVisibility);

        return $tryEnum ?? EnumVisibility::PUBLIC;
    }

    private function fetchMore(CemeteryStoreRequest $request, string $key): mixed
    {
        if (empty($request->more)) {
            return null;
        }

        return $request->more[$key] ?? null;
    }

    private function fetchNames(array $names): array
    {
        $name = array_shift($names);

        return [
            $name,
            $names,
        ];
    }

    private function createPhone(CemeteryStoreRequest $request): ?CemeteryPhoneDTO
    {
        if (empty($request->more['phone'])) {
            return null;
        }

        return new CemeteryPhoneDTO(
            href: $request->more['phone'],
            text: $request->more['phone'],
        );
    }

    private function createWebsite(CemeteryStoreRequest $request): ?CemeteryWebsiteDTO
    {
        if (empty($request->more['website'])) {
            return null;
        }

        return new CemeteryWebsiteDTO(
            url: $request->more['website'],
            text: $request->more['website'],
        );
    }
}
