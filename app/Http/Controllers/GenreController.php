<?php

namespace App\Http\Controllers;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function getGenre($id)
    {
        $data = Genre::where('id', '=', $id)->first();
        
        return view('pages/genre', $data);
    }
}
