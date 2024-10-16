<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\ServiceProvider;

use App\Models\Cemetery;

class CemeteryServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $router = $this->app['router'];

        $router->bind('cemeteryAbout', function (int $value) {
            return Cemetery::with([
                    'media' => function (MorphMany $morphMany) {
                        $morphMany->limit(3);
                    },
                    'additional_locations' => function(BelongsToMany $belongsToMany) {
                        $belongsToMany->with('parents');
                    },
                ])
                ->withCount('media')
                ->findOrFail($value);
        });

        $router->bind('cemeteryPhotos', function (int $value) {
            return Cemetery::with(['media'])
                ->with('additional_locations', fn($query) => $query->with('parents'))
                ->withCount('media')
                ->findOrFail($value);
        });

        $router->bind('cemeteryMap', function (int $value) {
            return Cemetery::withCount(['media'])
                ->with('additional_locations', fn($query) => $query->with('parents'))
                ->findOrFail($value);
        });
    }
}
