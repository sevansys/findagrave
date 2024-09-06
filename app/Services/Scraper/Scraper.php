<?php

namespace App\Services\Scraper;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

abstract class Scraper
{
    public abstract function start();

    public function getBase()
    {
        return config('scraper.base_url');
    }

    public function crawled(Response $response): void
    {
        $this->handle($response);
    }

    public function crawlFailed(Response $response, string $url): void
    {
        Log::error("Crawl failed", [
            "url" => $url,
            "body" => $response->getBody()->getContents(),
            "message" => $response->toException()?->getMessage(),
        ]);
    }

    public function makePath($path): string
    {
        return sprintf('%s/%s', $this->getBase(), $path);
    }

    public function scrap(string $path): Response
    {
        $url = $this->makePath($path);
        return Http::get($url);
    }
}
