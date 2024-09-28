<?php

namespace App\Http\Controllers\Json\Cemeteries\Autocomplete;

use App\Repositories\Cemetery\CemeteryRepository;
use Baghunts\LaravelFastEndpoints\Attributes\Get;
use Baghunts\LaravelFastEndpoints\Attributes\Name;
use Baghunts\LaravelFastEndpoints\Endpoint\Endpoint;

#[Get('/json/cemeteries/autocomplete')]
#[Name('cemeteries.autocomplete.json')]
class CemeteriesAutocompleteController extends Endpoint
{
    public function __invoke(
        CemeteriesAutocompleteRequest $request,
        CemeteryRepository $cemeteryRepository
    )
    {
        $cemeteries = $cemeteryRepository->autoComplete(
            $request->like
        );
        return CemeteriesAutocompleteResource::collection($cemeteries ?? []);
    }
}
