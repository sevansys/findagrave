<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CemeteryAdditionalLocations extends Model
{
    protected $fillable = [
        'cemetery_id',
        'location_id',
    ];

    public function cemeteries(): HasMany
    {
        return $this->hasMany(Cemetery::class);
    }
}
