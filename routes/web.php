<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AlbumController, MusicController};

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

//----------------------------------------------
Route::resource('albums', AlbumController::class);
Route::resource('musics', MusicController::class);

//Route::get('album/{id}/{nombre}', [AlbumController::class, 'show'])->middleware(['auth', 'verified'])->name('verAlbum');
Route::get('album/{album}/{nombre}', [AlbumController::class, 'mostrarAlbum'])->name('verAlbum');

require __DIR__.'/auth.php';
