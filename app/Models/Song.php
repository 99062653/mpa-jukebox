<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'genre_id',
        'artist',
        'length',
        'cover_art',
        'date_created',
        'date_added',
        'deleted'
    ];
}
