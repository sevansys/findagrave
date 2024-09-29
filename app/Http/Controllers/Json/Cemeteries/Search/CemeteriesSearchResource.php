<?php

namespace App\Http\Controllers\Json\Cemeteries\Search;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CemeteriesSearchResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'alt_name' => $this->alt_name,
            'href' => route('cemetery.about', [
                'cemeteryAbout' => $this->id,
                'slug' => Str::slug($this->name),
            ]),
            'image' => $this->whenLoaded(
                'media',
                $this->media->first()?->source_url ?? asset('/img/cemetery-no-photo.jpg')
            ),
            'photographed' => 10,
            'memorialsCount' => $this->whenLoaded('memorialsCount', $this->memeorialsCount, 0),
        ];
    }
}
