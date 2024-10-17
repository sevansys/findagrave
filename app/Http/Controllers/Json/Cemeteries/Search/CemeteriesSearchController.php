<?php

namespace App\Http\Controllers\Json\Cemeteries\Search;

use App\DTO\Cemeteries\CemeteriesSearchQueryDTO;
use App\Repositories\Cemetery\CemeteryRepository;
use Baghunts\LaravelFastEndpoints\Attributes\Get;
use Baghunts\LaravelFastEndpoints\Attributes\Name;
use Baghunts\LaravelFastEndpoints\Endpoint\Endpoint;

#[Get('/json/cemeteries/search')]
#[Name('cemeteries.search.json')]
class CemeteriesSearchController extends Endpoint
{
    public function __invoke(
        CemeteriesSearchRequest $request,
        CemeteryRepository $cemeteryRepository
    )
    {
        $cemeteries = $cemeteryRepository->search(new CemeteriesSearchQueryDTO(
            page: $request->page ?? 1,
            location_id: $request->location_id,
            cemetery: $request->cemetery,
        ));
        return CemeteriesSearchResource::collection($cemeteries);
    }
}
