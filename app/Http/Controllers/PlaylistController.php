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
        // return view('pages/playlist', $data);
        //session()->put('playlists.1.name', 'oke');    
        return dd(session('playlists'));
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

    public function edit(Request $req, $id)
    {

    }

    public function delete(Request $req)
    {
    }
}
