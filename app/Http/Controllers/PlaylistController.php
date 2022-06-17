<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Playlist;
use App\Models\Song;

class PlaylistController extends Controller
{
    public static function getIndex($id)
    {
        for ($i = 0; $i < count(session('playlists')); $i++) {
            if (session('playlists')[$i]['id'] == $id) {
               return $i;
            }
        }
    }

    // --DATABASE--
    public function getEloquentPlaylist($id)
    {
        $data = Playlist::where('id', '=', $id)->first();

        return view('pages/playlist', $data);
    }

    // --SESSION--
    public function getSessionPlaylist($id)
    {
        $data = session('playlists')[PlaylistController::getIndex($id)];

        //    session()->push('playlists.' . $id - 1 . '.songs', [
        //     'cover_art' => 'https://i.scdn.co/image/ab67616d00004851b9dbbd9d2f7215c1e52b4dd4',
        //     'name' => 'New Noise',
        //     'artist' => 'Refused',
        //     'genre' => 'Rock',
        //     'length' => '3:51',
        //     'date_added' => Carbon::now()
        //    ]);

        return view('pages/playlist', $data);
    }

    public function saveSessionPlaylist($id)
    {
        session()->put('playlists.' . [PlaylistController::getIndex($id)] . '.saved', true);

        return redirect('/user/playlist/' . $id);
    }

    public function editSessionPlaylist($id)
    {
        // session()->push('playlists.' . $id - 1 . '.songs', ['name' => 'obama']);
        //session()->put('playlists.1.name', 'oke');  
    }

    public function removeFromSessionPlaylist($id, $songId)
    {
        session()->pull('playlists.' . [PlaylistController::getIndex($id)] . '.songs.' . $songId);

        return redirect('/user/playlist/' . $id);
    }

    public function deleteSessionPlaylist($id)
    {
        session()->put('playlists.' . [PlaylistController::getIndex($id)] . '.deleted', true);

        return redirect('/user');
    }

    public function addToSessionPlaylist($id, Song $Song)
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
