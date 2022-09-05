<?php

namespace App\Http\Classes;

class PlaylistClass 
{
    public $Id;
    public $Name;
    public $Rgb_color;
    
    // --STATICS--
    public static function getPlaylistIndex($id)
    {
        for ($i = 0; $i < count(session('playlists')); $i++) {
            if (session('playlists')[$i]['id'] == $id) {
               return $i;
            }
        }
    }

    public static function getPlaylistData($id) 
    {
        $data = session('playlists')[PlaylistClass::getPlaylistIndex($id)];

        return $data;
    }

    public static function updatePlaylistStatus($id)
    {
        session()->put('playlists.' . PlaylistClass::getPlaylistIndex($id) . '.saved', false);
    }

    public static function calculatePlaylistDuration($id, $data) 
    {
        $amount = 0;
        $length = 0;

        foreach (session('playlists')[PlaylistClass::getPlaylistIndex($id)]['songs'] as $Song) {
            $length += ceil((float)str_replace(':', '.', $Song['length'])); //cast als float en ceil round hem up
            $amount++;
        }

        $data['length'] = $length;
        $data['amount'] = $amount;

        return $data;
    }
    
    //--REGULAR--
    public function createPlaylist($name, $rgb_color) 
    {
        if (session('playlists')) {
            foreach (session('playlists') as $playlist) {
                if ($playlist['name'] == $name) {
                    break;
                }
            }
        }

        if (session('playlists')) {
            $id = count(session('playlists')) + 1;
        } else {
            $id = 1;
        }

        $this->Id = $id;
        $this->Name = $name;
        $this->Rgb_color = $rgb_color;

        session()->push('playlists', ['id' => $id, 'name' => $name, 'rgb_color' => $rgb_color, 'songs' => [], 'saved' => false, 'deleted' => false]);
    }

    public function deletePlaylist($id)
    {
        session()->put('playlists.' . PlaylistClass::getPlaylistIndex($id) . '.deleted', true);
    }

    public function addToPlaylist($id, $songdata = [])
    {
        session()->push('playlists.' . PlaylistClass::getPlaylistIndex($id) . '.songs', [
            'id' => $songdata['id'],
            'name' => $songdata['name'],
            'artist' => $songdata['artist'],
            'cover_art' => $songdata['cover_art'],
            'genre_id' => $songdata['genre_id'],
            'length' => $songdata['length'],
            'date_added' => $songdata['date_added']
        ]);

        PlaylistClass::updatePlaylistStatus($id);
    }

    public function removeFromPlaylist($id, $songId)
    {
        session()->pull('playlists.' . PlaylistClass::getPlaylistIndex($id) . '.songs.' . $songId);

        PlaylistClass::updatePlaylistStatus($id);
    }

    public function savePlaylist($id)
    {
        session()->put('playlists.' . PlaylistClass::getPlaylistIndex($id) . '.saved', true);
    }

    public function unsavePlaylist($id)
    {
        session()->put('playlists.' . PlaylistClass::getPlaylistIndex($id) . '.saved', false);
    }
}