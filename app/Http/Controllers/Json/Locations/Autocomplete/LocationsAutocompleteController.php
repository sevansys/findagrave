<?php

namespace App\Http\Controllers\Json\Locations\Autocomplete;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

use Baghunts\LaravelFastEndpoints\Attributes\Get;
use Baghunts\LaravelFastEndpoints\Attributes\Name;
use Baghunts\LaravelFastEndpoints\Endpoint\Endpoint;

use App\Enums\EnumLocation;
use App\Repositories\Location\LocationRepository;

#[Name('locations.autocomplete.json')]
#[Get('/json/locations/autocomplete')]
class LocationsAutocompleteController extends Endpoint
{
    public function __invoke(
        LocationsAutocompleteRequest $request,
        LocationRepository $locationRepository,
    )
    {
        $locations = $locationRepository->autoComplete(
            $request->like,
            $this->getLocationTypes($request->types),
        );

        return LocationsAutocompleteResource::collection(
            $locations ?? []
        );
    }

    private function getLocationTypes(?array $types): ?array
    {
        if (is_null($types)) {
            return null;
        }

        $data = [];
        foreach ($types as $type) {
            $enum = EnumLocation::tryFrom($type);
            if (!is_null($enum)) {
                $data[] = $enum;
            }
        }

        return $data;
    }
}
