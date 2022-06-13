<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    public function getSessionPlaylist($id)
    {
        $data = session('playlists')[$id -1]; // sessions tellen anders op dan mijn id systeem

        return view('pages/playlist', $data);
    }

    public function create(Request $req)
    {
        $id = 1;
        if (session('playlists')) {
            $id = count(session('playlists')) + 1;
        }
        session()->push('playlists', ['id' => $id,'name' => $req->name, 'rgb_color' => $req->color, 'songs' => []]);

        return redirect('/user');
    }

    public function edit(Request $req, $id)
    {
        if ($req === null) {
            $data = session('playlists')[$id -1]; // sessions tellen anders op dan mijn id systeem

            return view('pages/playlist', $data);
        }
    }

    public function delete(Request $req)
    {
    }
}
