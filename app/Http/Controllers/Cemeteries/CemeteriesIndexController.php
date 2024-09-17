<?php

namespace App\Http\Controllers\Cemeteries;

use Illuminate\View\View;

use Baghunts\LaravelFastEndpoints\Endpoint\Endpoint;
use Baghunts\LaravelFastEndpoints\Attributes\{
    Get,
    Name,
};

#[Get('/cemeteries')]
#[Name('cemeteries-index')]
class CemeteriesIndexController extends Endpoint
{
    public function __invoke(): View
    {
        return view('pages.cemeteries.index');
    }
}
