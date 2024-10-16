<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('app:scrap-next-location')
    ->everyTwoSeconds()
    ->runInBackground();

//Schedule::command('app:scrap-next-cemetery')
//    ->everyFiveSeconds()
//    ->runInBackground();
