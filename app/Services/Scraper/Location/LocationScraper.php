<?php

namespace App\Services\Scraper\Location;

use Symfony\Component\DomCrawler\Crawler;

use Illuminate\Support\Str;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Storage;

use App\Enums\EnumLocation;
use App\Services\Scraper\Scraper;

class LocationScraper extends Scraper
{
    protected array $graph;

    const ITEMS_SELECTOR = ".name-grave > a";

    protected string $path = "/cemetery-browse";

    public function start(?string $locationId = null): mixed
    {
        $response = $this->scrap($this->getRootPath($locationId));
        foreach ($this->fetchItems($response) as $node) {
            if (!$node) {
                continue;
            }

            $this->graph[] = $this->produceItem(new Crawler($node));
        }

        foreach ($this->graph as $continent) {
            $this->scrapLocation($continent);
        }

        return Storage::put("locations.$locationId.json", json_encode($this->graph));
    }

    protected function scrapLocation(LocationDTO $location): void
    {
        dump($location);

        $response = $this->scrap($location->src);
        foreach ($this->fetchItems($response) as $node) {
            $node = new Crawler($node);
            $item = $this->produceItem($node);
            $this->scrapLocation($item);

            $location->items[] = $item;
        }
    }

    protected function produceItem(Crawler $node): LocationDTO
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

    protected function fetchItems(Response $response): Crawler
    {
        $crawler = new Crawler($response->getBody()->getContents());
        return $crawler->filter(self::ITEMS_SELECTOR);
    }

    private function getRootPath(?string $locationId = null): string
    {
        return sprintf(
            "%s%s",
            $this->path,
            $locationId ? "" : "/?id=$$locationId"
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
}
