<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'src',
        'type',
        'width',
        'height',
        'owner_id',
        'source_id',
        'owner_type',
        'contributor_id'
    ];

    protected $appends = [
        'source_url'
    ];

    public function getSourceUrlAttribute(): string
    {
        return sprintf(
            '%s%s',
            config('scraper.base_url'),
            $this->src ?? '',
        );
    }
}
