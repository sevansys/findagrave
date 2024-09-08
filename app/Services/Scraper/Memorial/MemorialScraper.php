<?php

namespace App\Services\Scraper\Memorial;

use Carbon\Carbon;
use Symfony\Component\DomCrawler\Crawler;

use Illuminate\Support\Str;

use App\Services\Scraper\Scraper;
use App\Services\Scraper\Media\MediaScraper;

class MemorialScraper extends Scraper
{
    private MemorialDTO $record;

    public function __construct(
        public string $src,
    ) {
        $this->record = new MemorialDTO(
            src: $src,
        );
    }

//    /**
//     * Uncomment to use stub HTML for a faster development process - MONUMENT
//     *
//     * @param string|null $path
//     * @return string
//     */
//    protected function fetchResponse(?string $path): string
//    {
//        return file_get_contents(app_path('Stubs/Scraper/memorial-single-about.html'));
//    }
//
//    /**
//     * Uncomment to use stub HTML for a faster development process - PERSON
//     *
//     * @param string|null $path
//     * @return string
//     */
//    protected function fetchResponse(?string $path): string
//    {
//        return file_get_contents(app_path('Stubs/Scraper/memorial-single-person-about.html'));
//    }

    public function start(): MemorialDTO
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
            ->produceId()
            ->produceBio()
            ->producePlot()
            ->produceRate()
            ->produceTitle()
            ->produceDeath()
            ->produceBirth()
            ->produceLabels()
            ->produceCreatedAt()
            ->produceCoordinates()
            ->produceInscription()
            ->producePrefixSuffix()
            ->produceGravityDetails();
    }

    private function produceId(): self
    {
        $person_id = $this->getScriptValue('personId');
        $source_id = $this->getScriptValue('memorialId');
        $contributor_id = $this->getScriptValue('contributorId');
        $cemetery_id = $this->getScriptValue('memorialCemeteryId');

        $this->record->source_id = empty($source_id) ? null : intval($source_id);
        $this->record->person_id = empty($person_id) ? null : intval($person_id);
        $this->record->cemetery_source_id = empty($cemetery_id) ? null : intval($cemetery_id);
        $this->record->contributor_id = empty($contributor_id) ? null : intval($contributor_id);

        return $this;
    }

    private function produceTitle(): self
    {
        $lastName = $this->getScriptValue('lastName');
        $firstName = $this->getScriptValue('firstName');
        $middleName = $this->getScriptValue('middleName');

        $this->record->last_name = !empty($lastName) ? $lastName : null;
        $this->record->first_name = !empty($firstName) ? $firstName : null;
        $this->record->middle_name = !empty($middleName) ? $middleName : null;

        return $this;
    }

    private function produceDeath(): self
    {
        $death = $this->getScriptValue('deathDate');
        $location = $this->crawler->filter("#deathLocationLabel")->first();

        if ($location->count()) {
            $this->record->death_location = $location->text();
        }

        $this->record->death = $death === 'unknown' ? null : Carbon::parse($death)->toDateString();

        return $this;
    }

    private function produceBirth(): self
    {
        $birth = $this->crawler->filter('#birthDateLabel')->first();
        $location = $this->crawler->filter('#birthLocationLabel')->first();

        if ($birth->count()) {
            $this->record->birth = $birth->text() === 'unknown' ? null : Carbon::parse($birth->text())->toDateString();
        }

        if ($location->count()) {
            $this->record->birth_location = $location->text();
        }

        return $this;
    }

    private function produceLabels(): self
    {
        $node = $this->crawler->filter('#bio-name .icon-vet')->first();

        $isFamous = $this->getScriptValue('isFamous');
        $isCenotaph = $this->getScriptValue('isCenotaph');
        $isMemorial = $this->getScriptValue('isMemorial');
        $isStillLiving = $this->getScriptValue('stillLiving');

        $this->record->is_veteran = !!$node->count();
        $this->record->is_famous = $isFamous === 'true';
        $this->record->is_memorial = $isMemorial === 'true';
        $this->record->is_cenotaph = $isCenotaph === 'true';
        $this->record->is_still_living = $isStillLiving === 'true';

        return $this;
    }

    private function produceCreatedAt(): self
    {
        $node = $this->crawler->filter('#addedDate')->first();

        if (!$node->count()) {
            return $this;
        }

        $this->record->created_at = Str::of($node->attr('value'))->after("Added: ");

        return $this;
    }

    private function produceBio(): self
    {
        $node = $this->crawler->filter('#fullBio')->first();

        if (!$node->count()) {
            return $this;
        }

        $this->record->bio = $node->html();

        return $this;
    }

    private function producePlot(): self
    {
        $node = $this->crawler->filter('#plotValueLabel')->first();

        if (!$node->count()) {
            return $this;
        }

        $this->record->plot = $node->html();

        return $this;
    }

    private function produceRate(): self
    {
        $rateNode = $this->crawler->filter('.stars-count')->first();
        $votesNode = $this->crawler->filter('.fameRankingVotes')->first();

        if ($rateNode->count()) {
            $this->record->famous_rate = $this->extractRateValue($rateNode);
        }

        if ($votesNode->count())  {
            $this->record->famous_rate_votes = $this->extractRateVotes($votesNode);
        }

        return $this;
    }

    private function extractRateValue(Crawler $node): float
    {
        $title = $node->attr('title');
        $value = Str::of($title)->before(' ');

        return floatval($value->toString());
    }

    private function extractRateVotes(Crawler $node): int
    {
        $value = Str::of($node->text())
            ->before(' ')
            ->replaceMatches('/\D/', '');

        return intval($value->toString());
    }

    private function produceGravityDetails(): self
    {
        $node = $this->crawler->filter('#gravesite-details');

        if (!$node->count()) {
            return $this;
        }

        $this->record->grave_details = $node->html();

        return $this;
    }

    private function produceCoordinates(): self
    {
        $node = $this->crawler->filter('#gpsValue');

        if (!$node->count()) {
            return $this;
        }

        $href = $node->attr('href');
        $query = parse_url($href, PHP_URL_QUERY);
        parse_str($query, $params);

        $coords = Str::of($params['spn'])
            ->explode(',')
            ->map(fn(string $value) => floatval($value))
            ->toArray();

        $this->record->coordinates = $coords;

        return $this;
    }

    private function produceInscription(): self
    {
        $node = $this->crawler->filter('#inscriptionValue');

        if (!$node->count()) {
            return $this;
        }

        $this->record->inscription = $node->html();

        return $this;
    }

    private function producePrefixSuffix(): self
    {
        $fullName = $this->getScriptValue('fullName');

        $prefix = (string)Str::of($fullName)->match('#&quot;prefix&quot;&gt;(.*)&lt;#');
        $suffix = (string)Str::of($fullName)->match('#&quot;suffix&quot;&gt;(.*)&lt;#');

        $this->record->prefix = !empty($prefix) ? $prefix : null;
        $this->record->suffix = !empty($suffix) ? $suffix : null;

        return $this;
    }

    private function producePhotos(): self
    {
        $this->record->photos = $this->makePhotos();

        return $this;
    }

    private function makePhotos(): array
    {
        $json = $this->getScriptValue('photos', true) ?? [];

        return collect($json['photos'] ?? [])
            ->reduce(function (array $payload, array $photo) {
                $payload[] =  MediaScraper::fromScriptData($photo);

                return $payload;
            }, []);
    }
}
