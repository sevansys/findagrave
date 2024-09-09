<?php

use Illuminate\Support\Facades\Route;

Route::get('/memorial', function () {
    \Illuminate\Support\Facades\Artisan::call('app:scrap-memorial', [
//        'src' => '/memorial/19599/105th_pennsylvania_infantry_monument',
        'src' => '/memorial/253313066/abraham-a_sancta_clara',
    ]);;

    return view('welcome');
});

Route::get('/cemetery', function () {
    \Illuminate\Support\Facades\Artisan::call('app:scrap-cemetery', [
        'src' => '/cemetery/1966577/white-house-cemetery'
    ]);
});
