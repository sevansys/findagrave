<?php

namespace App\Http\Controllers\Memorials;

use Illuminate\View\View;

use Baghunts\LaravelFastEndpoints\Endpoint\Endpoint;
use Baghunts\LaravelFastEndpoints\Attributes\{
    Get,
    Name,
};

#[Get('/memorial')]
#[Name('memorials-index')]
class MemorialsIndexController extends Endpoint
{
    public function __invoke(): View
    {
        return view('pages.memorials.index');
    }
}
