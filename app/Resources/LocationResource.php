<?php

namespace App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'text' => $this->text,
            'href' =>   $this->getHref(),
            'parents' => LocationResource::make($this->whenLoaded('parents')),
            'children' => LocationResource::collection($this->whenLoaded('children')),
        ];
    }

    protected function getHref()
    {
        return sprintf('%d/%s',
            $this->id,
            $this->text,
        );
    }
}
