<?php

namespace App\Services\Scraper\Location;

use Symfony\Component\DomCrawler\Crawler;

use Illuminate\Support\Str;

use App\Enums\EnumLocation;
use App\Services\Scraper\Scraper;
use App\DTO\Location\LocationDTO;
use App\DTO\Cemetery\CemeteryDTO;
use Throwable;

class LocationScraper extends Scraper
{
    protected array $locations = [];

    protected array $cemeteries = [];

    const string ITEMS_SELECTOR = '.name-grave > a';

    public function __construct(
        private readonly string $src
    ) {}

//    protected function fetchResponse(?string $path): string
//    {
////        return file_get_contents(app_path('Stubs/Scraper/Location/country-cities.html'));
//        return file_get_contents(app_path('Stubs/Scraper/Location/with-cemeteries.html'));
//    }

    /**
     * @throws Throwable
     */
    public function start(): array
    {
        $this->scrap($this->src);

        foreach ($this->fetchItems() as $node) {
            if (!$node) {
                continue;
            }

            $item = $this->produceItem(new Crawler($node));

            if ($item instanceof LocationDTO) {
                $this->locations[] = $item;
            } else {
                $this->cemeteries[] = $item;
            }
        }

        return [$this->locations, $this->cemeteries];
    }

    protected function produceItem(Crawler $node): LocationDTO|CemeteryDTO
    {
        $src = $node->attr('href');

        $is_cemetery = $this->isCemeteryByUrl($src);

        if ($is_cemetery) {
            return $this->makeCemeteryItem($node, $src);
        } else {
            return $this->makeLocationItem($node, $src);
        }
    }

    private function makeCemeteryItem(Crawler $node, string $src): CemeteryDTO
    {
        return new CemeteryDTO(
            src: urldecode($src),
            name: $node->text(),
        );
    }

    private function makeLocationItem(Crawler $node, string $src): LocationDTO
    {
        $source_id = $this->extractId($src);
        $type = $this->detectLocationTypeByType($source_id);

        return new LocationDTO(
            src: urldecode($src),
            text: $node->text(),
            type: $type,
        );
    }

    protected function fetchItems(): Crawler
    {
        return $this->crawler->filter(self::ITEMS_SELECTOR);
    }

    private function extractId(string $src): string
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
