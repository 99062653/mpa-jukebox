<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends BaseModel
{
    use HasFactory;

    // VOOR DE TOEKOMST: SPECIALE HASH TOEVOEGEN ZODAT JE MEERDERE DEZELFDE NAAM PLAYLIST KAN HEBBEN
    protected $fillable = [
        'user_id',
        'name',
        'rgb_color',
        'date_created'
    ];
}
