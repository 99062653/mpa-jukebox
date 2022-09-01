<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Playlist;
use App\Models\Song;
use App\Models\SongInPlaylist;
use App\Http\Classes\PlaylistClass;
use Exception;

class PlaylistController extends Controller
{
    public static function loadPlaylists()
    {
        $id = 1;
        foreach (Playlist::where('user_id', '=', session('user_id'))->get() as $Playlist) {
            session()->push('playlists', ['id' => $id, 'name' => $Playlist->name, 'rgb_color' => $Playlist->rgb_color, 'songs' => [], 'saved' => true, 'deleted' => false]);
            foreach (SongInPlaylist::where('playlist_id', '=', $Playlist->id)->get() as $Song) {
                $actualSong = Song::where('id', '=', $Song->song_id)->first();
                session()->push('playlists.' .  PlaylistClass::getPlaylistIndex($id) . '.songs', [
                    'id' => $actualSong->id,
                    'name' => $actualSong->name,
                    'artist' => $actualSong->artist,
                    'cover_art' => $actualSong->cover_art,
                    'genre_id' => $actualSong->genre_id,
                    'length' => $actualSong->length,
                    'date_added' => $actualSong->date_added
                ]);
            }
            $id++;
        }
    }

    // --DATABASE--
    public function getEloquentPlaylist($id)
    {
        $data = Playlist::where('id', '=', $id)->first();
        $data['songs'] = [];
        $data['saved'] = true;
        $data['deleted'] = false;

        foreach (SongInPlaylist::where('playlist_id', '=', $id)->get() as $Result) {
            $data['songs'] += $Result;
        }

        $data = PlaylistClass::calculatePlaylistDuration($id, $data);

        return view('pages/playlist', $data);
    }

    // --SESSION--
    public function getSessionPlaylist($id)
    {
        $data = session('playlists')[PlaylistClass::getPlaylistIndex($id)];

        $data = PlaylistClass::calculatePlaylistDuration($id, $data);

        return view('pages/playlist', $data);
    }

    public function savePlaylist($id)
    {
        $data = session('playlists')[PlaylistClass::getPlaylistIndex($id)];
        $Playlist = Playlist::where('user_id', '=', session('user_id'))
            ->where('name', '=', $data['name'])
            ->first();
        session()->put('playlists.' . PlaylistClass::getPlaylistIndex($id) . '.saved', true);

        if ($Playlist == null) {
            $Playlist = Playlist::create(['user_id' => session('user_id'), 'name' => $data['name'], 'rgb_color' => $data['rgb_color'], 'date_created' => Carbon::now()]);
        } else {
            SongInPlaylist::where('playlist_id', $Playlist->id)->delete();
        }

        foreach (session('playlists')[PlaylistClass::getPlaylistIndex($id)]['songs'] as $Song) {
            SongInPlaylist::create(['song_id' => $Song['id'], 'playlist_id' => $Playlist->id]);
        }

        return redirect('/user/playlist/' . $id);
    }

    public function unsavePlaylist($id)
    {
        $data = session('playlists')[PlaylistClass::getPlaylistIndex($id)];
        $Playlist = Playlist::where('user_id', '=', session('user_id'))->where('name', '=', $data['name']);
        // $SongInPlaylists = SongInPlaylist::where()
        session()->put('playlists.' . PlaylistClass::getPlaylistIndex($id) . '.saved', false);

        $Playlist->delete();

        return redirect('/user/playlist/' . $id);
    }

    public function addToPlaylist($id, $songId)
    {
        $Song = Song::where('id', '=', $songId)->first();
        session()->push('playlists.' . PlaylistClass::getPlaylistIndex($id) . '.songs', [
            'id' => $Song->id,
            'name' => $Song->name,
            'artist' => $Song->artist,
            'cover_art' => $Song->cover_art,
            'genre_id' => $Song->genre_id,
            'length' => $Song->length,
            'date_added' => Carbon::now()
        ]);

        LogController::logAction('added song ' . $Song->name . ' to playlist ' . $id);
        PlaylistClass::updatePlaylistStatus($id);
        return redirect(url()->previous());
    }

    public function removeFromPlaylist($id, $songId)
    {
        $Song = Song::where('id', '=', $songId)->first();
        session()->pull('playlists.' . PlaylistClass::getPlaylistIndex($id) . '.songs.' . $songId);

        LogController::logAction('removed song ' . $Song->name . ' from playlist ' . $id);
        PlaylistClass::updatePlaylistStatus($id);
        return redirect('/user/playlist/' . $id);
    }

    public function deletePlaylist($id)
    {
        $data = session('playlists')[PlaylistClass::getPlaylistIndex($id)];
        $Playlist = Playlist::where('user_id', session('user_id'))->where('name', $data['name'])->first();

        try {
            foreach (SongInPlaylist::where('playlist_id', $Playlist->id)->get() as $ForeignKey) {
                $ForeignKey->delete();
            }

            $Playlist->delete();
        } catch (Exception $e) {

        }

        session()->put('playlists.' . PlaylistClass::getPlaylistIndex($id) . '.deleted', true);

        return redirect('/user');
    }

    public function createPlaylist(Request $req)
    {
        if (session('playlists')) {
            foreach (session('playlists') as $playlist) {
                if ($playlist['name'] == $req->name) {
                    return view('pages/playlist', ['issue' => 'Deze naam is al in gebruik']);
                }
            }
        }

        if (session('playlists')) {
            $id = count(session('playlists')) + 1;
        } else {
            $id = 1;
        }
        session()->push('playlists', ['id' => $id, 'name' => $req->name, 'rgb_color' => $req->color, 'songs' => [], 'saved' => false, 'deleted' => false]);

        LogController::logAction('created a playlist');
        return redirect('/user');
    }
}
