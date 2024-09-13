<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Cemetery extends Model
{
    protected $fillable = [
        'src',
        'name',
        'phone',
        'status',
        'website',
        'address',
        'alt_name',
        'location_id',
        'coordinates',
        'description',
    ];

    protected $casts = [
        'phone' => 'json',
        'website' => 'json',
        'alt_name' => 'json',
        'coordinates' => 'array',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'owner');
    }
}
