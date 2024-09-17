<?php

namespace App\Http\Controllers\Cemetery;

use Illuminate\View\View;

use Baghunts\LaravelFastEndpoints\Attributes\Get;
use Baghunts\LaravelFastEndpoints\Attributes\Name;
use Baghunts\LaravelFastEndpoints\Endpoint\Endpoint;

use App\Models\Cemetery;

#[Name('cemetery.about')]
#[Get('/cemetery/{cemeteryAbout}/{slug}')]
class CemeteryAboutController extends Endpoint
{
    public function __invoke(Cemetery $cemeteryAbout): View
    {
        return view('pages.cemetery.about', [
            'item' => $cemeteryAbout,
        ]);
    }
}
