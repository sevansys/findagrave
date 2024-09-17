<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Cemetery;

class CemeteryServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app['router']->bind('cemeteryAbout', function (int $value) {
            return Cemetery::with(['media'])->findOrFail($value);
        });
    }
}
