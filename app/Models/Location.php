<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Enums\EnumLocation;
use App\Models\Scopes\ScrapedRecord;

#[ScopedBy(ScrapedRecord::class)]
class Location extends Model
{
    public $fillable = [
        'src',
        'text',
        'type',
        'process',
        'parent_id',
        'scrap_status',
    ];

    protected $casts = [
        'type' => EnumLocation::class,
    ];

    public function scopeContinent(Builder $builder)
    {
        $builder->where('type', EnumLocation::CONTINENT);
    }


    public function scopeCountries(Builder $builder)
    {
        $builder->where('type', EnumLocation::COUNTRY);
    }

    public function scopeCounties(Builder $builder)
    {
        $builder->where('type', EnumLocation::COUNTY);
    }

    public function scopeStates(Builder $builder)
    {
        $builder->where('type', EnumLocation::STATE);
    }

    public function scopeCities(Builder $builder)
    {
        $builder->where('type', EnumLocation::CITY);
    }

    public function parent(): BelongsTo
    {
        return $this
            ->belongsTo(self::class, 'parent_id');
    }

    public function parents(): BelongsTo
    {
        return $this
            ->belongsTo(self::class, 'parent_id')
            ->with('parents');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function cemeteries(): HasMany
    {
        return $this->hasMany(Cemetery::class);
    }
}
