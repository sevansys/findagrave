<?php

namespace App\Services\Scraper\Cemetery;

use Carbon\Carbon;

use Symfony\Component\DomCrawler\Crawler;

use Illuminate\Support\Str;

use App\Enums\EnumMedia;
use App\Services\Scraper\Scraper;
use App\Services\Scraper\Media\MediaDTO;
use App\Services\Scraper\Media\MediaAuthorDTO;

class CemeteryPhotoScraper extends Scraper
{
    private ?Crawler $crawler;

    public function __construct(
        public string $src,
        private array $items = [],
    ) {}

    protected function getUrl(): string
    {
        return sprintf("%s/photo", $this->src);
    }

    public function start(): array
    {
        $response = file_get_contents(app_path('Stubs/Scraper/cemetery-single-photos.html'));
//        $response = $this->scrap($this->getUrl())->getBody()->getContents();

        $this->crawler = new Crawler($response);

        return $this
            ->produceItems()
            ->items;
    }

    private function produceItems(): self
    {
        foreach ($this->crawler->filter('.photos-board-item') as $photo) {
            if (empty($photo)) {
                continue;
            }

            $this->items[] = $this->produceItem(new Crawler($photo));
        }

        return $this;
    }

    private function produceItem(Crawler $item): MediaDTO
    {
        $addedBy = $item->filter('.added-by')->first();
        $image = $item->filter('[itemprop="image"]')->first();
        $caption = $item->filter('[itemprop="name"]')->first();



        return new MediaDTO(
            src: $image->attr('data-src'),
            type: EnumMedia::OTHER,
            caption: $caption->count() ? $caption->text() : null,
            added_at: $this->makeDate($addedBy),
            added_by: $this->makeAuthor($addedBy),
        );
    }

    private function makeDate(?Crawler $addedBy): ?string
    {
        if (!$addedBy->count()) {
            return null;
        }

        $text = Str::of($addedBy->innerText())->substr(2);
        return Carbon::parse($text)->toAtomString();
    }

    private function makeAuthor(Crawler $addedBy): ?MediaAuthorDTO
    {
        $user = $addedBy->filter('a[href*="/user/profile"]')->first();
        $src = $user->attr('href');

        preg_match("#/user/profile/(\d*)#", $src, $matches);

        return new MediaAuthorDTO(
            id: intval($matches[1]),
            src: $src,
            fullName: $user->text(),
        );
    }
}
