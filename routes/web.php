<?php

use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\RouteAction;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'home');

// Route::view('/user', 'user');
Route::view('/user/login', 'entry/login');
Route::view('/user/register', 'entry/register');

Route::view('/playlist', 'pages/playlist');
Route::view('/playlist/create', 'pages/playlist');
Route::view('/playlist/edit', 'pages/playlist');


Route::controller(EntryController::class)->group(function () {
    Route::post('/user/login', [EntryController::class, 'login']);
    Route::post('/user/register', [EntryController::class, 'register']);
    Route::get('/user/logout', [EntryController::class, 'logout']);
});

Route::controller(PlaylistController::class)->group(function () {
    Route::post('/playlist/create', [PlaylistController::class, 'create']);
    Route::post('/playlist/edit', [PlaylistController::class, 'edit']);
    Route::get('/playlist/delete', [PlaylistController::class, 'delete']);
});

Route::get('songs', [Songcontroller::class, 'getSongs']);

Route::get('/user', [UserController::class, 'getSessionUser']);