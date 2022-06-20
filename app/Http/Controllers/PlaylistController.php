<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Playlist;
use App\Models\Song;

class PlaylistController extends Controller
{
    public static function getPlaylistIndex($id)
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
        $data = session('playlists')[PlaylistController::getPlaylistIndex($id)];

        return view('pages/playlist', $data);
    }

    public function saveSessionPlaylist($id)
    {
        session()->put('playlists.' . PlaylistController::getPlaylistIndex($id) . '.saved', true);

        return redirect('/user/playlist/' . $id);
    }

    public function editSessionPlaylist($id)
    {
        // session()->push('playlists.' . $id - 1 . '.songs', ['name' => 'obama']);
        //session()->put('playlists.1.name', 'oke');  
    }

    public function addToSessionPlaylist($id, $songId)
    {
        $Song = Song::where('id', '=', $songId)->first();
        session()->push('playlists.' . PlaylistController::getPlaylistIndex($id) . '.songs', [
            'name' => $Song->name,
            'artist' => $Song->artist,
            'cover_art' => $Song->cover_art,
            'genre' => $Song->genre_id,
            'length' => $Song->length,
            'date_added' => Carbon::now()
        ]);

    }

    public function removeFromSessionPlaylist($id, $songId)
    {
        session()->pull('playlists.' . PlaylistController::getPlaylistIndex($id) . '.songs.' . $songId);

        return redirect('/user/playlist/' . $id);
    }

    public function deleteSessionPlaylist($id)
    {
        session()->put('playlists.' . PlaylistController::getPlaylistIndex($id) . '.deleted', true);

        return redirect('/user');
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
