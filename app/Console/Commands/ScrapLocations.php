<?php

namespace App\Console\Commands;

use App\Jobs\Scraper\ScrapContinentJob;
use App\Services\Scraper\Location\LocationScraper;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

class ScrapLocations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:scrap-locations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {

        (new LocationScraper())->start();
//
//
//        $response  = Http::get("https://www.findagrave.com/cemetery-browse");
//        $crawler = new Crawler($response->getBody()->getContents());
//
//        $regions = [];
//        $crawler->filter('.name-grave > a')->each(function(Crawler $node) use (&$regions) {
//            $href = $node->attr("href");
//            $url = parse_url($href, PHP_URL_QUERY);
//            parse_str($url, $query);
//
//            $regions[] = [
//                "href" => $href,
//                "text" => $node->text(),
//                "source_id" => $query["id"],
//            ];
//        });
//
//        dd($regions);
    }
}
