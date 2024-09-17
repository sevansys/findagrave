<?php

namespace App\Http\Controllers\Famous;

use Illuminate\View\View;

use Baghunts\LaravelFastEndpoints\Endpoint\Endpoint;
use Baghunts\LaravelFastEndpoints\Attributes\{
    Get,
    Name,
};

#[Get('/famous')]
#[Name('famous-index')]
class FamousIndexController extends Endpoint
{
    public function __invoke(): View
    {
        return view('pages.famous.index');
    }
}
