<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Playlist;
use App\Models\Song;
use App\Models\PlaylistSong;
use Exception;

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

    public static function calculateDuration($id, $data) {
        $amount = 0;
        $length = 0;

        foreach (session('playlists')[PlaylistController::getPlaylistIndex($id)]['songs'] as $Song) {
            $length += ceil((float)str_replace(':', '.', $Song['length'])); //cast als float en ceil round hem up
            $amount++;
        }

        $data['length'] = $length;
        $data['amount'] = $amount;

        return $data;
    }

    public static function loadPlaylists()
    {
        $id = 1;
        foreach (Playlist::all()->where('user_id', '=', session('user_id')) as $Playlist) {
            session()->push('playlists', ['id' => $id, 'name' => $Playlist->name, 'rgb_color' => $Playlist->rgb_color, 'songs' => [], 'saved' => true, 'deleted' => false]);
            foreach (PlaylistSong::all()->where('playlist_id', '=', $Playlist->id) as $Song) {
                $actualSong = Song::where('id', '=', $Song->song_id)->first();
                session()->push('playlists.' .  PlaylistController::getPlaylistIndex($id) . '.songs', [
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
        $data['saved'] = true;

        foreach (PlaylistSong::where('playlist_id', '=', $id) as $songid) {
            $data['songids'] += $songid;
        }

        $Newdata = PlaylistController::calculateDuration($id, $data);

        return view('pages/playlist', $Newdata);
    }

    // --SESSION--
    public function getSessionPlaylist($id)
    {
        $data = session('playlists')[PlaylistController::getPlaylistIndex($id)];

        $Newdata = PlaylistController::calculateDuration($id, $data);

        return view('pages/playlist', $Newdata);
    }

    public function savePlaylist($id)
    {
        $data = session('playlists')[PlaylistController::getPlaylistIndex($id)];
        $Playlist = Playlist::where('user_id', '=', session('user_id'))
            ->where('name', '=', $data['name'])
            ->first();
        session()->put('playlists.' . PlaylistController::getPlaylistIndex($id) . '.saved', true);

        if ($Playlist == null) {
            $Playlist = Playlist::create(['user_id' => session('user_id'), 'name' => $data['name'], 'rgb_color' => $data['rgb_color'], 'date_created' => Carbon::now()]);
        } else {
            PlaylistSong::where('playlist_id', $Playlist->id)->delete();
        }

        foreach (session('playlists')[PlaylistController::getPlaylistIndex($id)]['songs'] as $Song) {
            PlaylistSong::create(['song_id' => $Song['id'], 'playlist_id' => $Playlist->id]);
        }

        return redirect('/user/playlist/' . $id);
    }

    public function unsavePlaylist($id)
    {
        $data = session('playlists')[PlaylistController::getPlaylistIndex($id)];
        $Playlist = Playlist::where('user_id', '=', session('user_id'))->where('name', '=', $data['name']);
        // $PlaylistSongs = PlaylistSong::where()
        session()->put('playlists.' . PlaylistController::getPlaylistIndex($id) . '.saved', false);

        $Playlist->delete();

        return redirect('/user/playlist/' . $id);
    }

    public function editSessionPlaylist($id)
    {
        //session()->push('playlists.' . $id - 1 . '.songs', ['name' => 'obama']);
        //session()->put('playlists.1.name', 'oke');  
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
        $data = session('playlists')[PlaylistController::getPlaylistIndex($id)];
        $Playlist = Playlist::where('user_id', session('user_id'))->where('name', $data['name'])->first();

        try {
            foreach (PlaylistSong::all()->where('playlist_id', $Playlist->id) as $ForeignKey) {
                $ForeignKey->delete();
            }

            $Playlist->delete();
        } catch (Exception $e) {

        }

        session()->put('playlists.' . PlaylistController::getPlaylistIndex($id) . '.deleted', true);

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
