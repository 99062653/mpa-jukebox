<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use HasFactory;

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
                if ($user->role_id == 2) {
                    session()->put('user_admin', true);
                }

                session()->put('user_id', $user->id);
                return redirect('/');
            } else {
                return view('pages/user', ['issue' => 'Dit wachtwoord is niet juist', 'username' => $req->username]);
            }
        } else {
            return view('pages/user', ['issue' => 'Dit account bestaat niet', 'username' => $req->username]);
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
            return view('pages/user', ['issue' => 'Dit account bestaat al', 'username' => $req->username]);
        }
    }

    public function logout()
    {
        session()->flush(); //vergeet alles

        return redirect('/');
    }
    //MISC
    public function changePassword(Request $req)
    {
        $user = User::where('id', session('user_id'))->first();
        if (Hash::check($req->oldpass, $user->password)) {
            $Hashedpassword = Hash::make($req->newpass);
            $user->password = $Hashedpassword;
            $user->save();

            return redirect('/user');
        } else {
            return view('pages/user', ['issue' => 'Dit is niet het juiste password']);
        }
    }

    public function getSessionUser()
    {
        if (session('user_id')) {
            $user = User::where('id', session('user_id'))->first();

            return view('pages/user', ['username' => $user->username, 'password' => $user->password, 'date_created' => $user->date_created]);
        }
        return view('/');
    }
}
