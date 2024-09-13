<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class CemeteryController extends Controller
{
    public function index(): View
    {
        return view('pages.cemeteries.index');
    }
}
