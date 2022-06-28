<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\UserController;
use App\Models\Playlist;
use App\Models\Song;
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

// ~~ VIEW ~~
Route::view('/', 'home');

Route::view('/user/login', 'pages/user');
Route::view('/user/register', 'pages/user');
Route::view('/user/edit/password', 'pages/user');

Route::view('/playlist', 'pages/playlist');
Route::view('/playlist/create', 'pages/playlist');
Route::view('/playlist/edit', 'pages/playlist');

Route::view('/song/create', 'pages/song');
Route::view('/song/edit', 'pages/song');

Route::view('/genres', 'pages/genre');

// ~~ GET ~~

Route::get('/user', [UserController::class, 'getSessionUser']);

Route::get('/genre/{genreId}', [GenreController::class, 'getGenre']);

// ~~ GROUP ~~
Route::controller(UserController::class)->group(function () {
    Route::post('/user/login', [UserController::class, 'login']);
    Route::post('/user/register', [UserController::class, 'register']);
    Route::get('/user/logout', [UserController::class, 'logout']);

    Route::post('/user/edit/password', [UserController::class, 'changePassword']);
});

Route::controller(PlaylistController::class)->group(function () {
    Route::post('/playlist/create', [PlaylistController::class, 'createPlaylist']);
    Route::get('/user/playlist/{playlistId}', [PlaylistController::class, 'getSessionPlaylist']);
    Route::get('/user/playlist/{playlistId}/edit', [PlaylistController::class, 'editPlaylist']);
    Route::get('/user/playlist/{playlistId}/save', [PlaylistController::class, 'savePlaylist']);
    Route::get('/user/playlist/{playlistId}/unsave', [PlaylistController::class, 'unsavePlaylist']);
    Route::get('/user/playlist/{playlistId}/delete', [PlaylistController::class, 'deletePlaylist']);

    Route::get('/user/playlist/{playlistId}', [PlaylistController::class, 'getSessionPlaylist']);
    Route::get('/playlist/{playlistId}', [PlaylistController::class, 'getEloquentPlaylist']);

    Route::get('/user/playlist/{playlistId}/add/{songId}', [PlaylistController::class, 'addToPlaylist']);
    Route::get('/user/playlist/{playlistId}/remove/{songId}', [PlaylistController::class, 'removeFromPlaylist']);
});

Route::controller(SongController::class)->group(function () {
    Route::post('/song/create', [SongController::class, 'createSong']);
    Route::post('/song/edit', [SongController::class, 'edit']);
    Route::get('/song/delete', [SongController::class, 'delete']);
});

Route::controller(AdminController::class)->group(function () {
    Route::view('/admin/panel', 'pages/admin');
    Route::view('/admin/users', 'pages/admin');
    Route::view('/admin/songs', 'pages/admin');

    Route::view('/admin/genres', 'pages/admin');
    Route::view('/admin/logs', 'pages/admin');
});
