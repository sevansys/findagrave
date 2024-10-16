<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

use DB;

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
        'latitude',
        'longitude',
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


    protected static function booted(): void
    {
        self::creating(function(Cemetery $model) {
            self::createLocationPointer($model);
        });

        self::updating(function(Cemetery $model) {
            self::createLocationPointer($model);
        });
    }

    public static function createLocationPointer(Cemetery $model): void
    {
        if (!$model->latitude || !$model->longitude) {
            return;
        }

        $model->location_point = DB::raw("POINT($model->latitude, $model->longitude)");
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function additional_locations(): BelongsToMany
    {
        return $this->belongsToMany(
            Location::class,
            'cemetery_additional_locations',
            'cemetery_id',
            'location_id',
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
