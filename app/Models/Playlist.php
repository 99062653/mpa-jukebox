<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'rgb_color',
        'date_created'
    ];
}
