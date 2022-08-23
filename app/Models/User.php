<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'username',
        'password',
        'role_id',
        'date_created'
    ];
}
