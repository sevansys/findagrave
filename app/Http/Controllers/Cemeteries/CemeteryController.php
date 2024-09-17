<?php

namespace App\Http\Controllers\Cemeteries;

use Illuminate\View\View;

use Baghunts\LaravelFastEndpoints\Endpoint\Endpoint;
use Baghunts\LaravelFastEndpoints\Attributes\{
    Get,
    Name,
    WhereNumber,
};

use App\Models\Cemetery;

#[Name('cemetery')]
#[WhereNumber('cemetery')]
#[Get('/cemetery/{cemetery}/{name?}')]
class CemeteryController extends Endpoint
{
    public function __invoke(Cemetery $cemetery): View
    {
        return view('pages.cemeteries.single');
    }
}
