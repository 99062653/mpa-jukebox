<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Playlist;

class PlaylistController extends Controller
{
    public function getEloquentPlaylist($id)
    {
        $data = Playlist::where('id', '=', $id)->first();

        return view('pages/playlist', $data);
    }

    public function getSessionPlaylist($id)
    {
        for ($i = 0; $i < count(session('playlists')); $i++) {
            if (session('playlists')[$i]['id'] == $id) {
               $data = session('playlists')[$i];
            }
        }
        return view('pages/playlist', $data);
    }

    public function editSessionPlaylist($id)
    {
        // session()->push('playlists.' . $id - 1 . '.songs', ['name' => 'obama']);
        //session()->put('playlists.1.name', 'oke');  
    }

    public function deleteSessionPlaylist($id)
    {

    }

    public function addToSessionPlaylist($id, $song)
    {

    }

    public function createSessionPlaylist(Request $req)
    {
        $id = 1;
        if (session('playlists')) {
            $id = count(session('playlists')) + 1;
        }
        session()->push('playlists', ['id' => $id,'name' => $req->name, 'rgb_color' => $req->color, 'songs' => []]);

        return redirect('/user');
    }
}
