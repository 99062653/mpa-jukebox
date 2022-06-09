<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    //ENTRY
    public function login(Request $req)
    {
        $username = User::select('*')
            ->where('username', '=', $req->username)
            ->where('deleted', '=', 0)
            ->get();

        if (count($username) != 0) {
            $user = User::where('username', $req->username)->first();

            if (Hash::check($req->password, $user->password)) {

                session()->put('user_id', $user->id);
                return redirect('/');
            } else {
                return view('pages/entry', ['issue' => 'Dit wachtwoord is niet juist', 'username' => $req->username]);
            }
        } else {
            return view('pages/entry', ['issue' => 'Dit account bestaat niet', 'username' => $req->username]);
        }
    }

    public function register(Request $req)
    {
        $username = User::where('username', '=', $req->username)->first();

        if ($username === null) {
            $Hashedpassword = Hash::make($req->password);

            $user = User::create(['username' => $req->username, 'password' => $Hashedpassword, 'role_id' => 1, 'date_created' => Carbon::now()]);

            session()->put('user_id', $user->id);
            return redirect('/');
        } else {
            return view('pages/entry', ['issue' => 'Dit account bestaat al', 'username' => $req->username]);
        }
    }

    public function logout()
    {
        session()->flush(); //vergeet alles

        return redirect('/');
    }
    //MISC

}
