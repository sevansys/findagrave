<?php

use Illuminate\Support\Facades\Route;

Route::get('/memorial', function () {
    \Illuminate\Support\Facades\Artisan::call('app:scrap-memorial', [
//        'src' => '/memorial/19599/105th_pennsylvania_infantry_monument',
//        'src' => '/memorial/253313066/abraham-a_sancta_clara',
        'src' => '/memorial/25917457/terry-glenn_dd-cartee',
    ]);;

    return view('welcome');
});

Route::get('/cemetery', function () {
    \Illuminate\Support\Facades\Artisan::call('app:scrap-cemetery', [
        'src' => '/cemetery/1966577/white-house-cemetery'
    ]);
});

Route::get('/cemetery/memorials', function () {
    \Illuminate\Support\Facades\Artisan::call('app:scrap-cemetery-memorials', [
        'src' => '/cemetery/2143601/memorial-search',
        'page' => 1,
    ]);
});
