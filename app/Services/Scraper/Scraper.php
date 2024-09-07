<?php

namespace App\Services\Scraper;

use Symfony\Component\DomCrawler\Crawler;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

abstract class Scraper
{
    protected ?Crawler $crawler = null;

    public abstract function start();

    public function getBase()
    {
        return config('scraper.base_url');
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
