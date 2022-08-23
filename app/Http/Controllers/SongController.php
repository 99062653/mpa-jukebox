<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Song;

class SongController extends Controller
{
    public function getGenre($id)
    {
        $data = Song::where('id', '=', $id)->first();
        
        return view('pages/song', $data);
    }
}
