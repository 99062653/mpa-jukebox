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
use App\Http\Classes\PlaylistClass;

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

Route::get('/', function () {
    return view('home');
});

Route::view('/genres', 'pages/genre');

Route::get('/user', [UserController::class, 'getSessionUser']);

Route::get('/genre/{genreId}', [GenreController::class, 'getGenre']);
Route::get('/song/{songId}', [Song::class, 'getSong']);

Route::controller(UserController::class)->group(function () {
    Route::prefix('user')->group(function () {
        Route::view('/login', 'pages/user');
        Route::view('/register', 'pages/user');
        Route::view('/edit/password', 'pages/user');
        
        Route::post('/login', [UserController::class, 'login']);
        Route::post('/register', [UserController::class, 'register']);
        Route::get('/logout', [UserController::class, 'logout']);

        Route::post('/edit/password', [UserController::class, 'changePassword']);
    });
});

Route::controller(AdminController::class)->group(function () {
    Route::prefix('admin')->group(function () {
        Route::view('/panel', 'pages/admin');
        Route::view('/users', 'pages/admin');
        Route::view('/songs', 'pages/admin');

        Route::view('/genres', 'pages/admin');
        Route::view('/logs', 'pages/admin');
    });
});

Route::controller(PlaylistController::class)->group(function () {
    Route::prefix('user')->group(function () {
        Route::prefix('playlist')->group(function () {
            Route::view('/create', 'pages/playlist');
            Route::post('/create', [PlaylistController::class, 'createPlaylist']);
            Route::post('/{playlistId}/edit', [PlaylistController::class, 'editPlaylist']);
            Route::get('/{playlistId}', [PlaylistController::class, 'getPlaylist']);
            Route::get('/{playlistId}/edit', [PlaylistController::class, 'getPlaylistEdit']);
            Route::get('/{playlistId}/save', [PlaylistController::class, 'savePlaylist']);
            Route::get('/{playlistId}/unsave', [PlaylistController::class, 'unsavePlaylist']);
            Route::get('/{playlistId}/delete', [PlaylistController::class, 'deletePlaylist']);

            Route::get('/{playlistId}/add/{songId}', [PlaylistController::class, 'addToPlaylist']);
            Route::get('/{playlistId}/remove/{songId}', [PlaylistController::class, 'removeFromPlaylist']);
        });  
    });

    Route::view('/playlist', 'pages/playlist');
    Route::view('/playlist/edit', 'pages/playlist');
    Route::get('/playlist/{playlistId}', [PlaylistController::class, 'getEloquentPlaylist']);
});