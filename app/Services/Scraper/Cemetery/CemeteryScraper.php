<?php

namespace App\Services\Scraper\Cemetery;

use App\DTO\Cemetery\CemeteryDTO;
use App\DTO\Cemetery\CemeteryPhoneDTO;
use App\DTO\Cemetery\CemeteryWebsiteDTO;
use App\Services\Scraper\Media\MediaScraper;
use App\Services\Scraper\Scraper;
use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;

class CemeteryScraper extends Scraper
{
    private CemeteryDTO $record;

    public function __construct(
        private readonly string $src,
    ) {
        $this->record = new CemeteryDTO(
            src: $this->src,
            name: "Unknown",
        );
    }

//    /**
//     * Uncomment to use stub HTML for a faster development process
//     *
//     * @param string|null $path
//     * @return string
//     */
//    protected function fetchResponse(?string $path): string
//    {
//        return file_get_contents(app_path('Stubs/Scraper/Cemetery/single-with-alt-names.html'));
////        return file_get_contents(app_path('Stubs/Scraper/Cemetery/single-about.html'));
//    }

    public function start(): CemeteryDTO
    {
        $this->scrap($this->src)
            ->withFindAGraveScript();

        return $this
            ->produceAbout()
            ->producePhotos()
            ->record;
    }

    private function produceAbout(): self
    {
        return $this
            ->produceUrl()
            ->produceTitle()
            ->producePhone()
            ->produceAddress()
            ->produceSourceId()
            ->produceAltNames()
            ->produceSearchUrl()
            ->produceDescription()
            ->produceCoordinates();
    }

    private function producePhotos(): self
    {

        $photosString = $this->script
            ->after('photos:')
            ->beforeLast('}')
            ->trim()
            ->append('}');

        $photos = json_decode($photosString, true) ?? [];
        $photos = $photos["photos"] ?? null;

        if (empty($photos)) {
            return $this;
        }

        $this->record->photos = MediaScraper::fromScriptData($photos);

        return $this;
    }

    private function produceUrl(): self
    {
        $node = $this->crawler->filter('[itemprop="url"]')->first();

        if (!$node->count()) {
            return $this;
        }

        $this->record->website = new CemeteryWebsiteDTO(
            url: $node->attr('href'),
            text: $node->text()
        );

        return $this;
    }

    private function produceSearchUrl(): self
    {
        $search_url = $this->getScriptValue("searchUrl") ?? null;

        $this->record->search_url = !empty($search_url) ? $search_url : null;

        return $this;
    }

    private function producePhone(): self
    {
        $node = $this->crawler->filter('.icon-phone + span > a')->first();

        if (!$node->count()) {
            return $this;
        }

        $this->record->phone = new CemeteryPhoneDTO(
            href: $node->attr('href'),
            text: $node->text(),
        );

        return $this;
    }
    private function produceDescription(): self
    {
        $node = $this->crawler->filter('#fullBio')->first();

        if (!$node->count()) {
            return $this;
        }

        $this->record->description = $node->html();

        return $this;
    }


    private function produceCoordinates(): self
    {
        $data = [];
        foreach ($this->crawler->filter('.compyme > span') as $item) {
            $item = new Crawler($item);
            $data[] = floatval($item->text());
        }

        $this->record->latitude = $data[0] ?? null;
        $this->record->longitude = $data[1] ?? null;

        return $this;
    }

    private function produceSourceId(): self
    {
        preg_match("#/cemetery/(\d*)/#", $this->src, $matches);
        $this->record->source_id = intval($matches[1]);

        return $this;
    }

    private function produceTitle(): self
    {
        $node = $this->crawler->filter('#profile-section .bio-name');

        if (!$node->count()) {
            return $this;
        }

        $this->record->name = $node->first()->text();

        return $this;
    }

    private function produceAltNames(): self
    {
        $node = $this->crawler->filter('[itemprop="alternateName"]');

        if (!$node->count()) {
            return $this;
        }

        $names = [];
        foreach ($node as $item) {
            $item = new Crawler($item);
            $names[] = $item->text();
        }

        $this->record->alt_name = $names;

        return $this;
    }

    private function produceAddress(): self
    {
        $node = $this->crawler->filter('address');

        if (!$node->count()) {
            return $this;
        }

        $this->record->address = Str::of($node->text())->after("Get directions ");

        return $this;
    }
}
