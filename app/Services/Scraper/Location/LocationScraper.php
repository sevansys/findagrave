<?php

namespace App\Services\Scraper\Location;

use Illuminate\Http\Client\Response;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\DomCrawler\Crawler;

use App\Enums\EnumLocation;
use App\Services\Scraper\Scraper;

class LocationScraper extends Scraper
{
    protected array $graph;

    private int $depth = 0;

    protected string $path = "/cemetery-browse";
    const ITEMS_SELECTOR = ".name-grave > a";

    public function start(): void
    {
        $response = $this->scrap($this->path);
        foreach ($this->fetchItems($response) as $node) {
            if (!$node) {
                continue;
            }

            $this->graph[] = $this->produceItem(new Crawler($node));
        }

        foreach ($this->graph as $continent) {
            $this->scrapLocation($continent);
        }

        Storage::put('locations.json', json_encode($this->graph));
    }

    protected function scrapLocation(LocationDTO $location): void
    {
        $response = $this->scrap($location->src);
        foreach ($this->fetchItems($response) as $node) {
            $node = new Crawler($node);
            $item = $this->produceItem($node);
            $this->scrapLocation($item);

            $location->items[] = $item;
        }
    }

    private function produceItem(Crawler $node): LocationDTO
    {
        $src = $node->attr('href');

        $is_cemetery = $this->isCemeteryByUrl($src);

        $source_id = $this->extractId($src, $is_cemetery);
        $type = $is_cemetery ? EnumLocation::CEMETERY : $this->detectLocationTypeByType($source_id);

        return new LocationDTO(
            src: $src,
            text: $node->text(),
            source_id: $source_id,
            type: $type,
            items: [],
        );
    }

    private function extractId(string $src, bool $isCementer): ?string
    {
        if ($isCementer) {
            return $this->extractCemeteryId($src);
        } else {
            return $this->extractLocationId($src);
        }
    }

    private function extractCemeteryId(string $src): string
    {
        return $src;
    }

    private function extractLocationId(string $src): string
    {
        $url = parse_url($src, PHP_URL_QUERY);
        parse_str($url, $params);

        return $params["id"] ?? "";
    }

    private function detectLocationTypeByType(string $id): ?EnumLocation
    {
        $type = strtoupper(explode("_", $id)[0] ?? "");

        return constant(sprintf(
            "App\Enums\EnumLocation::%s",
            $type
        )) ?? null;
    }

    private function isCemeteryByUrl(string $src): bool
    {
        return Str::of($src)->test('#^\/cemetery\/\d+#');
    }

    private function fetchItems(Response $response): Crawler
    {
        $crawler = new Crawler($response->getBody()->getContents());
        return $crawler->filter(self::ITEMS_SELECTOR);
    }
}
