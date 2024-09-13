<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Media extends Model
{
    use HasFactory;

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
}
