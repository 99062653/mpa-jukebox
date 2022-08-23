<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SongInPlaylist extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'song_id',
        'playlist_id'
    ];
}
