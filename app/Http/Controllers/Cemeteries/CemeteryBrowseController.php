<?php

namespace App\Http\Controllers\Cemeteries;

use Illuminate\View\View;
use Illuminate\Http\Request;

use Baghunts\LaravelFastEndpoints\Endpoint\Endpoint;
use Baghunts\LaravelFastEndpoints\Attributes\{Get, Name, Where};

use App\Repositories\Location\LocationRepository;

#[Where('slug', '(.*)')]
#[Name('cemeteries-browse')]
#[Get('/cemeteries/browse/{slug?}')]
class CemeteryBrowseController extends Endpoint
{
    public function __invoke(Request $request, LocationRepository $locationRepository): View
    {
        $extractedId = $this->extractId($request->route('slug', ''));

        return view('pages.cemeteries.browse', [
            'item' => $locationRepository->childrenForBrowse($extractedId),
        ]);
    }

    private function extractId(string $slug): ?int
    {
        if (empty($slug)) {
            return null;
        }

        $segments = explode('/', $slug);
        $lastSegment = array_slice($segments, -2, 1)[0] ?? null;

        return $lastSegment ? (int)$lastSegment : null;
    }
}
