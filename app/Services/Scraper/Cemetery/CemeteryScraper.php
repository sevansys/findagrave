<?php

namespace App\Services\Scraper\Cemetery;

use Symfony\Component\DomCrawler\Crawler;

use App\Services\Scraper\Scraper;

class CemeteryScraper extends Scraper
{
    private CemeteryDTO $record;
    private ?Crawler $crawler = null;

    public function __construct(
        private readonly string $src,
    ) {
        $this->record = new CemeteryDTO(
            src: $this->src,
            name: "",
        );
    }

    public function start(): CemeteryDTO
    {
         $response = file_get_contents(app_path('Stubs/Scraper/cemetery-single-about.html'));
        // $response = $this->scrap($this->src)->getBody()->getContents();

        $this->crawler = new Crawler($response);

        $this
            ->produceAbout()
            ->producePhotos();

        dd($this->record);

        return $this->record;
    }

    private function produceAbout(): self
    {
        return $this
            ->produceSourceId()
            ->produceTitle()
            ->produceDescription()
            ->produceCoordinates()
            ->produceUrl()
            ->producePhone()
            ->produceAddress();
    }

    private function producePhotos(): self
    {
        $this->record->photos = (new CemeteryPhotoScraper($this->src))->start() ?? [];

        return $this;
    }

    private function produceUrl(): self
    {
        $node = $this->crawler->filter('[itemprop="url"]')?->first();

        if (!$node) {
            return $this;
        }

        $this->record->website = new CemeteryWebsiteDTO(
            url: $node->attr('href'),
            text: $node->text()
        );

        return $this;
    }

    private function producePhone(): self
    {
        $node = $this->crawler->filter('.icon-phone + span > a')?->first();

        if (!$node) {
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
        $this->record->description = $this->crawler->filter('#fullBio')?->first()?->html();
        return $this;
    }


    private function produceCoordinates(): self
    {
        $data = [];
        foreach ($this->crawler->filter('.compyme > span') as $item) {
            $item = new Crawler($item);
            $data[] = floatval($item->text());
        }

        $this->record->coordinates = array_splice($data, 0, 2);
        return $this;
    }

    private function produceSourceId(): self
    {
        preg_match("#\/cemetery\/(\d*)\/#", $this->src, $matches);
        $this->record->source_id = intval($matches[1]);

        return $this;
    }

    private function produceTitle(): self
    {
        $this->record->name = $this->crawler->filter('#profile-section .bio-name')?->first()->text()
            ?? "Unknown";

        return $this;
    }

    private function produceAddress(): self
    {
        $node = $this->crawler->filter('address > span')?->first();

        if (!$node) {
            return $this;
        }

        $this->record->address = $node->html();

        return $this;
    }
}
