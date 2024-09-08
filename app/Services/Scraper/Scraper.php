<?php

namespace App\Services\Scraper;

use DOMElement;
use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

use Stringable;

abstract class Scraper
{
    protected Stringable $script;

    protected ?Crawler $crawler = null;

    protected ?Response $response = null;

    const string EXPRESSION = '#%s:\s{1,}({.*}|.*|".*")#';

    public abstract function start();

    public function getBase()
    {
        return config('scraper.base_url');
    }

    public function makePath($path): string
    {
        return sprintf('%s/%s', $this->getBase(), $path);
    }

    public function scrap(string $path): self
    {
        $this->crawler = new Crawler($this->fetchResponse($path));

        return $this;
    }

    public function withFindAGraveScript(): self
    {
        $this->script = $this->fetchFindAGraveScriptPayload();

        return $this;
    }

    protected function getScriptValue(string $key, bool $isJson = false): null|string|array
    {

        $value = $this->script->match(sprintf(self::EXPRESSION, $key));
        $value = Str::of($value)
            ->rtrim(",")
            ->trim('"')
            ->trim("'");

        if ($isJson) {
            $value = json_decode((string)$value, true);
        }

        return $value;
    }

    protected function fetchResponse(?string $path): string
    {
        $url = $this->makePath($path);
        $this->response = Http::get($url);

        return $this->response->getBody()->getContents();
    }

    protected function fetchFindAGraveScriptPayload(): Stringable
    {
        $scripts = $this->crawler->filter('script');

        $definitionScript = collect($scripts)->filter(function (DOMElement $node) {
            return preg_match("#var findagrave =#", $node->textContent);
        })->first();
        $scriptContent = (new Crawler($definitionScript))->html();

        return Str::of($scriptContent)
            ->after('{')
            ->before("};");
    }
}
