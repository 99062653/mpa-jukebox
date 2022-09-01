<?php

namespace App\Http\Classes;

class PlaylistClass 
{
    public $Id;
    public $Name;
    public $Rgb_color;
    
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
        session()->put('playlists.' . PlaylistClass::getPlaylistIndex($id) . '.saved', false);
    }

    public static function calculatePlaylistDuration($id, $data) {
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
}