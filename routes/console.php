<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('scrap-next-location', function () {
})->everyTenSeconds()->runInBackground();
