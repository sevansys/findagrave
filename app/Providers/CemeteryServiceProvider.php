<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Cemetery;

class CemeteryServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $router = $this->app['router'];

        $router->bind('cemeteryAbout', function (int $value) {
            return Cemetery::with(['media'])->findOrFail($value);
        });

        $router->bind('cemeteryPhotos', function (int $value) {
            return Cemetery::with(['media'])->findOrFail($value);
        });
    }
}
