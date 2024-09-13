<?php

namespace App\Enums;

enum EnumScrapStatus: int
{
    case NEED_SCRAPING = 0;
    case SCRAPED = 1;
    case SCRAPING = 2;
    case SCRAP_FAILED = 3;
}
