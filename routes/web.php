<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Http\Controllers\HomeController::class)->name('home');

Route::resource('memorial', \App\Http\Controllers\MemorialController::class)
    ->name('index', 'memorial');

Route::resource('cemetery', \App\Http\Controllers\CemeteryController::class)
    ->name('index', 'cemetery');

Route::resource('famous', \App\Http\Controllers\FamousController::class)
    ->name('index', 'famous');
