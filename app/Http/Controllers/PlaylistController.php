<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    public function create(Request $req)
    {
        $id = 1;
        if (session('playlists')) {
            $id = count(session('playlists')) + 1;
        }
        session()->push('playlists', ['id' => $id,'name' => $req->name]);

        return redirect('/user');
    }

    public function edit(Request $req)
    {
    }

    public function delete(Request $req)
    {
    }
}
