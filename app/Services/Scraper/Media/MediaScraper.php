<?php

namespace App\Services\Scraper\Media;

use App\Enums\EnumMedia;
use App\Services\Scraper\Scraper;
use Carbon\Carbon;
use Illuminate\Support\Str;

class MediaScraper extends Scraper
{
    public function start()
    {
        // TODO: Implement start() method.
    }

    public static function getTypeFromString(?string $type): ?EnumMedia
    {
        if (is_null($type)) {
            return null;
        }

        $type = Str::of($type)->upper();
        $expression = sprintf("App\Enums\EnumMedia::%s", $type);

        try {
            return constant($expression);
        } catch (\Exception $exception) {
            report($exception);
            return null;
        }
    }

    public static function fromScriptData(array $data): MediaDTO
    {
        $contributor = $data["contributor"] ?? [];
        $contributor_id = $data["contributorId"] ?? $contributor["id"];

        $src = parse_url($data["path"], PHP_URL_PATH);

        return new MediaDTO(
            src: $src,
            width: $data["width"],
            height: $data["height"],
            source_id: intval($data['id']),
            caption: $data["caption"],
            type: self::getTypeFromString($data["type"]),
            created_at: Carbon::parse($data["dateCreated"])->toDateString(),
            contributor_id: intval($contributor_id),
        );
    }
}
