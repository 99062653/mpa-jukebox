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
        $playlistClass = new PlaylistClass();
        $id = 1;
        foreach (Playlist::where('user_id', '=', session('user_id'))->get() as $Playlist) {
            $playlistClass->createPlaylist($Playlist->name, $Playlist->rgb_color);
            $playlistClass->changePlaylistStatus($id, true);
            foreach (SongInPlaylist::where('playlist_id', '=', $Playlist->id)->get() as $Song) {
                $actualSong = Song::where('id', '=', $Song->song_id)->first();
                $songData = [
                    'id' => $actualSong->id,
                    'name' => $actualSong->name,
                    'artist' => $actualSong->artist,
                    'cover_art' => $actualSong->cover_art,
                    'genre_id' => $actualSong->genre_id,
                    'length' => $actualSong->length,
                    'date_added' => $actualSong->date_added
                ];
                $playlistClass->addToPlaylist($id, $songData);
            }
            $id++;
        }
    }

    // --DATABASE--
    public function getEloquentPlaylist($playlistId)
    {
        $data = Playlist::where('id', '=', $playlistId)->first();
        $data['songs'] = [];
        $data['saved'] = true;
        $data['deleted'] = false;

        foreach (SongInPlaylist::where('playlist_id', '=', $playlistId)->get() as $Result) {
            $data['songs'] += $Result;
        }

        $data = PlaylistClass::calculatePlaylistDuration($playlistId, $data);

        return view('pages/playlist', $data);
    }

    // --SESSION--
    public function getPlaylist($playlistId)
    {
        $data = PlaylistClass::getPlaylistData($playlistId);
        $data = PlaylistClass::calculatePlaylistDuration($playlistId, $data);

        return view('pages/playlist', $data);
    }

    public function getPlaylistEdit($playlistId)
    {
        $data = PlaylistClass::getPlaylistData($playlistId);

        return view('pages/playlist', $data);
    }

    public function createPlaylist(Request $req)
    {
        $playlistClass = new PlaylistClass();
        $playlistClass->createPlaylist($req->name, $req->color);

        return redirect('/user');
    }

    public function editPlaylist(Request $req)
    {
        $playlistClass = new PlaylistClass();
        $playlistClass->editPlaylist($req->id, $req->name, $req->color);

        return redirect('/user');
    }

    public function deletePlaylist($playlistId)
    {
        $data = PlaylistClass::getPlaylistData($playlistId);
        $playlistClass = new PlaylistClass();
        $Playlist = Playlist::select('*')
                            ->where('user_id', '=', session('user_id'))
                            ->where('uniqid', '=', $data['uniqid'])
                            ->first();

        try {
            foreach (SongInPlaylist::where('playlist_id', $Playlist->id)->get() as $ForeignKey) {
                $ForeignKey->delete();
            }

            $Playlist->delete();
        } catch (Exception $e) {
            
        }

        $playlistClass->deletePlaylist($playlistId);
        return redirect('/user');
    }

    public function addToPlaylist($playlistId, $songId)
    {
        $playlistClass = new PlaylistClass();
        $Song = Song::where('id', '=', $songId)->first();
        $songData = [
            'id' => $Song->id,
            'name' => $Song->name,
            'artist' => $Song->artist,
            'cover_art' => $Song->cover_art,
            'genre_id' => $Song->genre_id,
            'length' => $Song->length,
            'date_added' => Carbon::now()
        ];
        
        $playlistClass->addToPlaylist($playlistId, $songData);
        $playlistClass->changePlaylistStatus($playlistId, false);

        return redirect('/user/playlist/' . $playlistId);
    }

    public function removeFromPlaylist($playlistId, $songId)
    {
        $playlistClass = new PlaylistClass();
        $playlistClass->removeFromPlaylist($playlistId, $songId);
        $playlistClass->changePlaylistStatus($playlistId, false);

        return redirect('/user/playlist/' . $playlistId);
    }

    public function savePlaylist($playlistId)
    {
        $data = PlaylistClass::getPlaylistData($playlistId);
        $playlistClass = new PlaylistClass();
        $Playlist = Playlist::select('*')
                            ->where('user_id', '=', session('user_id'))
                            ->where('uniqid', '=', $data['uniqid'])
                            ->first();
                            
        if ($Playlist == null) {
            $Playlist = Playlist::create(['uniqid' => $data['uniqid'], 'user_id' => session('user_id'), 'name' => $data['name'], 'rgb_color' => $data['rgb_color'], 'date_created' => Carbon::now()]);
        } else {
            SongInPlaylist::where('playlist_id', $Playlist->id)->delete();
        }

        foreach ($data['songs'] as $Song) {
            SongInPlaylist::create(['song_id' => $Song['id'], 'playlist_id' => $Playlist->id]);
        }

        $playlistClass->changePlaylistStatus($playlistId, true);

        return redirect('/user/playlist/' . $playlistId);
    }

    public function unsavePlaylist($playlistId)
    {
        $data = PlaylistClass::getPlaylistData($playlistId);
        $playlistClass = new PlaylistClass();
        $Playlist = Playlist::select('*')
                            ->where('user_id', '=', session('user_id'))
                            ->where('uniqid', '=', $data['uniqid'])
                            ->first();

        foreach (SongInPlaylist::where('playlist_id', $Playlist->id)->get() as $Song) {
            $Song->delete();
        }

        $Playlist->delete();
        $playlistClass->calculatePlaylistDuration($playlistId, false);

        return redirect('/user/playlist/' . $playlistId);
    }
}
