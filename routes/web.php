<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    \Illuminate\Support\Facades\Artisan::call('app:scrap-cemetery', [
        'src' => '/cemetery/1966577/white-house-cemetery'
    ]);
    return view('welcome');
});
