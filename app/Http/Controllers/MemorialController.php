<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class MemorialController extends Controller
{
    public function index(): View
    {
        return view('pages.memorials.index');
    }
}
