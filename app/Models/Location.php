<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Enums\EnumLocation;

class Location extends Model
{
    public $fillable = [
        'src',
        'text',
        'type',
        'status',
        'parent_id',
    ];

    protected $casts = [
        'type' => EnumLocation::class,
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
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
