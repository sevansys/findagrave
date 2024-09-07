<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    \Illuminate\Support\Facades\Artisan::call('app:scrap-cemetery');
    return view('welcome');
});
