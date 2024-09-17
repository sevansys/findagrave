<?php

use Illuminate\Support\Facades\Schedule;

//foreach (\App\Models\Location::countries()->get() as $country) {
Schedule::command('app:scrap-next-location')
    ->everyFiveSeconds()
    ->runInBackground();
//}
//
//for ($i = 0; $i < 10; $i++) {
//    Schedule::command('app:scrap')->everyTenSeconds()->runInBackground();
//}
