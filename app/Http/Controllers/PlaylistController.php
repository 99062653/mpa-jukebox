<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Playlist;

class PlaylistController extends Controller
{
    // --DATABASE--
    public function getEloquentPlaylist($id)
    {
        $data = Playlist::where('id', '=', $id)->first();

        return view('pages/playlist', $data);
    }

    // --SESSION--
    public function getSessionPlaylist($id)
    {
        for ($i = 0; $i < count(session('playlists')); $i++) {
            if (session('playlists')[$i]['id'] == $id) {
               $data = session('playlists')[$i];

            //    session()->push('playlists.' . $id - 1 . '.songs', [
            //     'cover_art' => 'https://i.scdn.co/image/ab67616d00004851b9dbbd9d2f7215c1e52b4dd4',
            //     'name' => 'New Noise',
            //     'artist' => 'Refused',
            //     'genre' => 'Rock',
            //     'length' => '3:51',
            //     'date_added' => Carbon::now()
            //    ]);

            }
        }
        return view('pages/playlist', $data);
    }

    public function editSessionPlaylist($id)
    {
        // session()->push('playlists.' . $id - 1 . '.songs', ['name' => 'obama']);
        //session()->put('playlists.1.name', 'oke');  
    }

    public function removeFromSessionPlaylist($id, $songId)
    {
        session()->pull('playlists.' . $id - 1 . '.songs.' . $songId);

        return redirect('/user/playlist/' . $id);
    }

    public function deleteSessionPlaylist($id)
    {
        session()->put('playlists.' . $id - 1 . '.deleted', true);

        return redirect('/user');
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
        session()->push('playlists', ['id' => $id,'name' => $req->name, 'rgb_color' => $req->color, 'songs' => [], 'saved' => false, 'deleted' => false]);

        LogController::logAction('created a playlist');
        return redirect('/user');
    }

    public static function loadSessionPlaylists()
    {
        $id = 1;
        foreach (Playlist::all()->where('user_id', '=', session('user_id')) as $Playlist) {
            session()->push('playlists', ['id' => $id,'name' => $Playlist->name, 'rgb_color' => $Playlist->rgb_color, 'songs' => [], 'saved' => false]);
            $id++;
        }
    }
}
