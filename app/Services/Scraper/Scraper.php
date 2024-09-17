<?php

namespace App\Services\Scraper;

use Throwable;
use DOMElement;

use Symfony\Component\DomCrawler\Crawler;

use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Client\ConnectionException;

abstract class Scraper
{
    protected Stringable $script;

    protected ?Crawler $crawler = null;

    protected ?Response $response = null;

    const string EXPRESSION = '#%s:\s{1,}({.*}|.*|".*")#m';

    public abstract function start();

    public function getBase()
    {
        return config('scraper.base_url');
    }

    public function makePath($path): string
    {
        return sprintf('%s/%s', $this->getBase(), ltrim($path, '/'));
    }

    /**
     * @throws Throwable
     */
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

    /**
     * @throws Throwable
     */
    protected function fetchResponse(?string $path): string
    {
        $url = $this->makePath($path);
        $this->response = Http::get($url);

        throw_if(
            !$this->response->successful(),
            new ConnectionException(
                'Scrap failed! URL: ' . $url,
                $this->response->getStatusCode()
            )
        );

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
