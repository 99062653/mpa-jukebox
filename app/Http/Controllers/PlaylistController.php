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
            $playlistClass::changePlaylistStatus($id);
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
        $data = PlaylistClass::getPlaylistData($id);
        $data = PlaylistClass::calculatePlaylistDuration($id, $data);

        return view('pages/playlist', $data);
    }

    public function createPlaylist(Request $req)
    {
        $playlistClass = new PlaylistClass();
        $playlistClass->createPlaylist($req->name, $req->color);

        if (!$playlistClass->Name) {
            return view('pages/playlist', ['issue' => 'Deze naam is al in gebruik']);
        }

        return redirect('/user');
    }

    public function deletePlaylist($id)
    {
        $playlistClass = new PlaylistClass();
        $data = PlaylistClass::getPlaylistData($id);
        $Playlist = Playlist::where('user_id', session('user_id'))->where('name', $data['name'])->first();

        try {
            foreach (SongInPlaylist::where('playlist_id', $Playlist->id)->get() as $ForeignKey) {
                $ForeignKey->delete();
            }

            $Playlist->delete();
        } catch (Exception $e) {
            
        }

        $playlistClass->deletePlaylist($id);
        return redirect('/user');
    }

    public function addToPlaylist($id, $songId)
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
        
        $playlistClass->addToPlaylist($id, $songData);
        PlaylistClass::changePlaylistStatus($id);

        return redirect('/user/playlist/' . $id);
    }

    public function removeFromPlaylist($id, $songId)
    {
        $playlistClass = new PlaylistClass();
        $playlistClass->removeFromPlaylist($id, $songId);
        PlaylistClass::changePlaylistStatus($id);

        return redirect('/user/playlist/' . $id);
    }

    public function savePlaylist($id)
    {
        $data = PlaylistClass::getPlaylistData($id);
        $Playlist = Playlist::where('user_id', '=', session('user_id'))
            ->where('name', '=', $data['name'])
            ->first();

        if ($Playlist == null) {
            $Playlist = Playlist::create(['user_id' => session('user_id'), 'name' => $data['name'], 'rgb_color' => $data['rgb_color'], 'date_created' => Carbon::now()]);
        } else {
            SongInPlaylist::where('playlist_id', $Playlist->id)->delete();
        }

        foreach (session('playlists')[PlaylistClass::getPlaylistIndex($id)]['songs'] as $Song) {
            SongInPlaylist::create(['song_id' => $Song['id'], 'playlist_id' => $Playlist->id]);
        }

        PlaylistClass::changePlaylistStatus($id);

        return redirect('/user/playlist/' . $id);
    }

    public function unsavePlaylist($id)
    {
        $data = PlaylistClass::getPlaylistData($id);
        $Playlist = Playlist::where('user_id', '=', session('user_id'))->where('name', '=', $data['name']);

        $Playlist->delete();
        PlaylistClass::changePlaylistStatus($id);

        return redirect('/user/playlist/' . $id);
    }
}
