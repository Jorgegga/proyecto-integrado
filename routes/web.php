<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AboutusController, AdminController, AlbumController, AutorController, GeneroController, InicioController, MusicController, UserController};

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
Route::resource('inicios', InicioController::class);
Route::resource('autores', AutorController::class);
Route::resource('aboutus', AboutusController::class);
Route::resource('admins', AdminController::class);
Route::resource('generos', GeneroController::class);
Route::resource('users', UserController::class);

//Route::get('album/{id}/{nombre}', [AlbumController::class, 'show'])->middleware(['auth', 'verified'])->name('verAlbum');
Route::get('/album/{album}/{nombre}', [AlbumController::class, 'mostrarAlbum'])->name('verAlbum');
Route::get('/autor/{autor}/{nombre}', [AutorController::class, 'mostrarAutor'])->name('verAutor');

Route::get('/album/pagination', [AlbumController::class, 'pagination']);
Route::get('/tablas/album', [AdminController::class, 'album']);
Route::get('/tablas/autor', [AdminController::class, 'autor']);
Route::get('/tablas/music', [AdminController::class, 'musica']);
Route::get('/tablas/genero', [AdminController::class, 'genero']);
Route::get('/tablas/user', [AdminController::class, 'user']);
Route::get('/ajax-autocomplete-search', [AlbumController::class, 'selectSearch']);
Route::get('/autor/pagination', [AutorController::class, 'pagination']);

require __DIR__.'/auth.php';
