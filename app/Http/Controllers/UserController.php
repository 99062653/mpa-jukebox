<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    use HasFactory;

    public function getSessionUser()
    {
        if (session('user_id')) {
            $user = User::where('id', session('user_id'))->first();

            return view('pages/user', ['username' => $user->username, 'password' => $user->password, 'date_created' => $user->date_created]);
        } 
        return view('/');
    }
}
