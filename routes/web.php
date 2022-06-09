<?php

use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\GenreController;
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

Route::view('/user/login', 'pages/entry/login');
Route::view('/user/register', 'pages/entry/register');

Route::view('/playlist', 'pages/playlist');
Route::view('/playlist/create', 'pages/playlist');
Route::view('/playlist/edit', 'pages/playlist');

Route::get('/user', [UserController::class, 'getSessionUser']);

Route::get('/genre/{genreId}', [GenreController::class, 'getGenre']);

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