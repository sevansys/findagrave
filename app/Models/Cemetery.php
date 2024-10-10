<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

use App\Enums\EnumVisibility;
use App\Models\Scopes\ScrapedRecord;

#[ScopedBy(ScrapedRecord::class)]
class Cemetery extends Model
{
    protected $fillable = [
        'src',
        'name',
        'phone',
        'email',
        'status',
        'website',
        'address',
        'alt_name',
        'location',
        'visibility',
        'created_at',
        'updated_at',
        'location_id',
        'description',
        'scrap_status',
        'office_address',
        'additional_info',
    ];

    protected $casts = [
        'phone' => 'json',
        'website' => 'json',
        'alt_name' => 'json',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'visibility' => EnumVisibility::class,
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function additional_locations(): BelongsToMany
    {
        return $this->belongsToMany(
            CemeteryAdditionalLocations::class,
            'cemetery_additional_locations',
            'cemetery_id',
            'location_id',
            'id',
            'id',
        )->withTimestamps();
    }

//    public function memorials(): HasMany
//    {
//        return $this->hasMany(Memorial::class);
//    }

    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'owner');
    }

    public function toAboutRoute(): string
    {
        return route('cemetery.about', [
            'cemeteryAbout' => $this->id,
            'slug' => Str::of($this->name),
        ]);
    }
}
