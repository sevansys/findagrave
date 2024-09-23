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
            return Cemetery::with(['media' => fn ($query) => $query->limit(3)])
                ->withCount('media')
                ->findOrFail($value);
        });

        $router->bind('cemeteryPhotos', function (int $value) {
            return Cemetery::with(['media'])
                ->withCount('media')
                ->findOrFail($value);
        });

        $router->bind('cemeteryMap', function (int $value) {
            return Cemetery::withCount(['media'])->findOrFail($value);
        });
    }
}
