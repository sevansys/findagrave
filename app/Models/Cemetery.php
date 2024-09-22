<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

use App\Models\Scopes\ScrapedRecord;

#[ScopedBy(ScrapedRecord::class)]
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
        'latitude',
        'longitude',
        'created_at',
        'updated_at',
        'location_id',
        'description',
        'scrap_status',
    ];

    protected $casts = [
        'phone' => 'json',
        'website' => 'json',
        'alt_name' => 'json',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

//    public function memorials(): HasMany
//    {
//        return $this->hasMany(Memorial::class);
//    }

    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'owner');
    }
}
