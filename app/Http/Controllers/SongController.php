<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Song;

class Songcontroller extends Controller
{
    public function createSong(Request $req)
    {
        Song::create([
            'name' => $req->name,
            'genre_id' => $req->genre,
            'artist' => $req->artist,
            'length' => $req->length,
            'cover_art' => $req->cover,
            'date_created' => $req->date,
            'date_added' => Carbon::now(),
            'deleted' => 0
        ]);

        return redirect('/admin/songs');
    }
}
