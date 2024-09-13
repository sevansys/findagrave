<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class FamousController extends Controller
{
    public function index(): View
    {
        return view('pages.famous.index');
    }
}
