<?php

namespace App\Http\Controllers\Json\Locations\Autocomplete;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationsAutocompleteResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'value' => $this->id,
            'label' => $this->path,
        ];
    }
}
