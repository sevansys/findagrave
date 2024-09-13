<?php

namespace App\Providers;

use Illuminate\Http\Client\Factory as Http;
use Illuminate\Support\ServiceProvider;

class ScraperServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $proxy = config('scraper.proxy');

        $this->app->extend(Http::class, function(Http $service) use ($proxy) {
            if (empty($proxy)) {
                return $service;
            }

            return $service->withOptions([
                'proxy' => $proxy,
                'verify' => false,
            ]);
        });
    }

}
