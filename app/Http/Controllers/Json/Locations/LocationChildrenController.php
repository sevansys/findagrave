<?php

namespace App\Http\Controllers\Json\Locations;

use Baghunts\LaravelFastEndpoints\Attributes\Get;
use Baghunts\LaravelFastEndpoints\Attributes\Name;
use Baghunts\LaravelFastEndpoints\Endpoint\Endpoint;

use App\Repositories\Location\LocationRepository;
use Illuminate\Http\Resources\Json\ResourceCollection;

#[Get('/json/location/children')]
#[Name('locations.children.json')]
class LocationChildrenController extends Endpoint
{
    /**
     * @param LocationChildrenData $data
     * @param LocationRepository $repository
     * @return ResourceCollection<LocationChildrenResource>
     */
    public function __invoke(LocationChildrenData $data, LocationRepository $repository): ResourceCollection
    {
        $locations = $repository->browseLocation($data->parentId);
        return LocationChildrenResource::collection($locations);
    }
}
