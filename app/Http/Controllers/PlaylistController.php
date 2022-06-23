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

    public static function updatePlaylistStatus($id)
    {
        session()->put('playlists.' . PlaylistController::getPlaylistIndex($id) . '.saved', false);
    }

    public static function loadPlaylists()
    {
        $id = 1;
        foreach (Playlist::all()->where('user_id', '=', session('user_id')) as $Playlist) {
            session()->push('playlists', ['id' => $id,'name' => $Playlist->name, 'rgb_color' => $Playlist->rgb_color, 'songs' => [], 'saved' => true, 'deleted' => false]);
            $id++;
        }
    }

    public function getEloquentPlaylist($id)
    {
        $data = Playlist::where('id', '=', $id)->first();

        return view('pages/playlist', $data);
    }

    public function getSessionPlaylist($id)
    {
        $data = session('playlists')[PlaylistController::getPlaylistIndex($id)];

        return view('pages/playlist', $data);
    }

    public function savePlaylist($id)
    {
        $data = session('playlists')[PlaylistController::getPlaylistIndex($id)];
        session()->put('playlists.' . PlaylistController::getPlaylistIndex($id) . '.saved', true);

        if (count(Playlist::all()->where('user_id', '=', session('user_id'))->where('name', '=', $data['name'])) == 0) {
            Playlist::create(['user_id' => session('user_id'), 'name' => $data['name'], 'rgb_color' => $data['rgb_color'], 'date_created' => Carbon::now()]);
        }

        return redirect('/user/playlist/' . $id);
    }

    public function editPlaylist($id)
    {
        
    }

    public function addToPlaylist($id, $songId)
    {
        $Song = Song::where('id', '=', $songId)->first();
        session()->push('playlists.' . PlaylistController::getPlaylistIndex($id) . '.songs', [
            'id' => $Song->id,
            'name' => $Song->name,
            'artist' => $Song->artist,
            'cover_art' => $Song->cover_art,
            'genre_id' => $Song->genre_id,
            'length' => $Song->length,
            'date_added' => Carbon::now()
        ]);

        LogController::logAction('added song ' . $Song->name . ' to playlist ' . $id);
        PlaylistController::updatePlaylistStatus($id);
        return redirect(url()->previous());
    }

    public function removeFromPlaylist($id, $songId)
    {
        $Song = Song::where('id', '=', $songId)->first();
        session()->pull('playlists.' . PlaylistController::getPlaylistIndex($id) . '.songs.' . $songId);

        LogController::logAction('removed song ' . $Song->name . ' from playlist ' . $id);
        PlaylistController::updatePlaylistStatus($id);
        return redirect('/user/playlist/' . $id);
    }

    public function deletePlaylist($id)
    {
        session()->put('playlists.' . PlaylistController::getPlaylistIndex($id) . '.deleted', true);

        return redirect('/user');
    }

    public function createPlaylist(Request $req)
    {
        foreach (session('playlists') as $playlist) {
            if ($playlist['name'] == $req->name) {
                return view('pages/playlist', ['issue' => 'Deze naam is al in gebruik']);
            }
        }
        $id = 1;
        if (session('playlists')) {
            $id = count(session('playlists')) + 1;
        }
        session()->push('playlists', ['id' => $id,'name' => $req->name, 'rgb_color' => $req->color, 'songs' => [], 'saved' => false, 'deleted' => false]);

        LogController::logAction('created a playlist');
        return redirect('/user');
    }
}
