<?php

namespace App\Http\Controllers\Memorials;

use Illuminate\View\View;

use Baghunts\LaravelFastEndpoints\Attributes\Get;
use Baghunts\LaravelFastEndpoints\Attributes\Name;
use Baghunts\LaravelFastEndpoints\Endpoint\Endpoint;

#[Get('memorial/create')]
#[Name('memorial.create')]
class MemorialCreateController extends Endpoint
{
    public function __invoke(): View
    {
        return view('pages.memorials.create');
    }
}
