<?php

namespace App\Http\Controllers\Cemetery;

use Illuminate\View\View;

use Baghunts\LaravelFastEndpoints\Attributes\Get;
use Baghunts\LaravelFastEndpoints\Attributes\Name;
use Baghunts\LaravelFastEndpoints\Endpoint\Endpoint;

#[Name('cemetery.map')]
#[Get('/cemetery/{cemeteryMap}/{slug}/map')]
class CemeteryMapController extends Endpoint
{
    public function __invoke(): View
    {
        return view('pages.cemetery.map');
    }
}
