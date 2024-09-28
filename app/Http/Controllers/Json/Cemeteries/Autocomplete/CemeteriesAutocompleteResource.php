<?php

namespace App\Http\Controllers\Json\Cemeteries\Autocomplete;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CemeteriesAutocompleteResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'value' => $this->id,
            'label' => $this->name,
        ];
    }
}
