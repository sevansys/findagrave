<?php

namespace App\Http\Controllers\Home;

use Illuminate\View\View;

use Baghunts\LaravelFastEndpoints\Endpoint\Endpoint;
use Baghunts\LaravelFastEndpoints\Attributes\{
    Get,
    Name,
};

#[Get('/')]
#[Name('home')]
class HomeController extends Endpoint
{
    public function __invoke(): View
    {
        return view('pages.home.index');
    }
}
