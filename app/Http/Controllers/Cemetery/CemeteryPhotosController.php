<?php

namespace App\Http\Controllers\Cemetery;

use App\Models\Cemetery;
use Illuminate\View\View;

use Baghunts\LaravelFastEndpoints\Attributes\Get;
use Baghunts\LaravelFastEndpoints\Attributes\Name;
use Baghunts\LaravelFastEndpoints\Endpoint\Endpoint;

#[Name('cemetery.photos')]
#[Get('/cemetery/{cemeteryPhotos}/{slug}/photos')]
class CemeteryPhotosController extends Endpoint
{
    public function __invoke(Cemetery $cemeteryPhotos): View
    {
        return view('pages.cemetery.photos', [
            'item' => $cemeteryPhotos
        ]);
    }
}
