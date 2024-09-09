<?php

namespace App\Services\Scraper\User;

use Symfony\Component\DomCrawler\Crawler;

use App\Services\Scraper\Scraper;

class UserScraper extends Scraper
{

    public function start()
    {
        // TODO: Implement start() method.
    }

    public static function getIdFromSiblingNode(Crawler $node): ?int
    {
        $href = $node->attr('href');

        preg_match('#memorial/(\d*)#', $href ?? "", $matches);

        if (!empty($matches[1])) {
            return intval($matches[1]);
        }

        return null;
    }
}
