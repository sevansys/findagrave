<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('app:scrap-next-location')
    ->everySecond()
    ->runInBackground();

//Schedule::command('app:scrap-next-cemetery')
//    ->everyFiveSeconds()
//    ->runInBackground();
