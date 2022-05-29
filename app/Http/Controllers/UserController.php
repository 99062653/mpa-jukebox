<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //ENTRY
    public function login(Request $req) {
        $username = DB::table('users')->where([
            ['username', '=', $req->username],
            ['deleted', '=', 0],
        ])->get();

        if (count($username) != 0) {
            $user = DB::table('users')->select('*')->where('username', $req->username)->first();

            if (Hash::check($req->password, $user->password)) {

                session()->put('user', ['name' => $req->username, 'created_on' => $user->date_created, 'password' => $user->password]);
                return redirect('/');
            }
            else {
                return view('login', ['issue' => 'Dit wachtwoord is niet juist', 'username' => $req->username]);
            }
        } else {
            return view('login', ['issue' => 'Dit account bestaat niet', 'username' => $req->username]);
        }
    }

    public function register(Request $req) {
        $username = DB::table('users')->where([
            ['username', '=', $req->username]
        ])->get();

        if (count($username) == 0) {
            $Hashedpassword = Hash::make($req->password);

            DB::insert('INSERT INTO users (username, password, role_id, date_created) values (?, ?, ?, ?)', [$req->username, $Hashedpassword, 0, Carbon::now()]);

            session()->put('user', ['name' => $req->username, 'created_on' => Carbon::now(), 'password' => $Hashedpassword]);
            return redirect('/');
        } else {
            return view('register', ['issue' => 'Dit account bestaat al', 'username' => $req->username]);
        }
    }

    public function logout() {
        session()->flush(); //vergeet alles

        return redirect('/');
    }
    //MISC

}
