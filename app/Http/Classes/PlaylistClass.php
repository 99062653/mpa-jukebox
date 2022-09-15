<?php

namespace App\Http\Classes;

class PlaylistClass 
{
    public $Id;
    public $Uniqid;
    public $Name;
    public $Rgb_color;
    
    // --STATICS--

    //haal de playlist index op door middel van een gegeven id
    public static function getPlaylistIndex($playlistId)
    {
        for ($i = 0; $i < count(session('playlists')); $i++) {
            if (session('playlists')[$i]['id'] == $playlistId) {
               return $i;
            }
        }
    }

    //geeft data terug door een gegeven id
    public static function getPlaylistData($playlistId) 
    {
        $data = session('playlists')[PlaylistClass::getPlaylistIndex($playlistId)];

        return $data;
    }

    //rekent uit hoeveel minuten een playlist duurt doormiddel van id en data
    public static function calculatePlaylistDuration($playlistId, $data) 
    {
        $amount = 0;
        $length = 0;

        foreach (session('playlists')[PlaylistClass::getPlaylistIndex($playlistId)]['songs'] as $Song) {
            $length += ceil((float)str_replace(':', '.', $Song['length'])); //cast als float en ceil round hem up
            $amount++;
        }

        $data['length'] = $length;
        $data['amount'] = $amount;

        return $data;
    }
    
    //--REGULAR--

    //maakt een lokale playlist aan
    public function createPlaylist($name, $rgb_color) 
    {
        if (session('playlists')) {
            $id = count(session('playlists')) + 1;
        } else {
            $id = 1;
        }

        $this->Id = $id;
        $this->Uniqid = uniqid();
        $this->Name = $name;
        $this->Rgb_color = $rgb_color;

        session()->push('playlists', ['id' => $id, 'uniqid' =>$this->Uniqid,  'name' => $name, 'rgb_color' => $rgb_color, 'songs' => [], 'saved' => false, 'deleted' => false]);
    }

    //past een lokale playlist aan
    public function editPlaylist($playlistId, $name, $rgb_color) 
    {
        session()->put('playlists.' . PlaylistClass::getPlaylistIndex($playlistId) . '.name', $name);
        session()->put('playlists.' . PlaylistClass::getPlaylistIndex($playlistId) . '.rgb_color', $rgb_color);
    }

    //verwijdert een lokale playlist
    public function deletePlaylist($playlistId)
    {
        session()->put('playlists.' . PlaylistClass::getPlaylistIndex($playlistId) . '.deleted', true);
    }

    //voegt een liedje toe aan een lokale playlist
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
    }

    //verwijdert een liedje van een lokale playlist
    public function removeFromPlaylist($playlistId, $songid)
    {
        session()->pull('playlists.' . PlaylistClass::getPlaylistIndex($playlistId) . '.songs.' . $songid);
    }

    //verandert de lokale playlist door middel van een id en een true/false statement
    public function changePlaylistStatus($playlistId, $state)
    {
        session()->put('playlists.' . PlaylistClass::getPlaylistIndex($playlistId) . '.saved', $state);
    }
}