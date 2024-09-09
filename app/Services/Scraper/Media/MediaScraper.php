<?php

namespace App\Services\Scraper\Media;

use Exception;

use Carbon\Carbon;

use Illuminate\Support\Str;

use App\Enums\EnumMedia;
use App\Services\Scraper\Scraper;

class MediaScraper extends Scraper
{
    public function start() {}

    public static function fromScriptData(array $data): array
    {
        return array_reduce($data, function (array $payload, array $item) {
            $payload[] = self::fromScriptDataItem($item);

            return $payload;
        }, []);
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
        } catch (Exception $exception) {
            report($exception);
            return null;
        }
    }

    public static function fromScriptDataItem(array $data): MediaDTO
    {
        $contributor = $data["contributor"] ?? [];
        $contributor_id = $data["contributorId"] ?? $contributor["id"] ?? null;

        $src = parse_url($data["path"] ?? "", PHP_URL_PATH);

        $type = $data["type"] ?? null;
        $width = $data["with"] ?? null;
        $height = $data["height"] ?? null;
        $caption = $data["caption"] ?? null;
        $source_id = !empty($data["id"]) ? intval($data["id"]) : null;
        $contributor_id = $contributor_id ? intval($contributor_id) : null;
        $created_at = !empty($data["dateCreated"]) ? Carbon::parse($data["dateCreated"])->toDateString() : null;

        return new MediaDTO(
            src: $src,
            width: $width,
            height: $height,
            source_id: $source_id,
            caption: $caption,
            type: self::getTypeFromString($type),
            created_at: $created_at,
            contributor_id: $contributor_id,
        );
    }
}
