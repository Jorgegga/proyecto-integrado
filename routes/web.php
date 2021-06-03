<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AboutusController, AdminController, AlbumController, AreaController, AutorController, ContactoController, GeneroController, InicioController, MusicController, UserController, PlaylistController};

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
Route::resource('playlists', PlaylistController::class);

//Creacion de un update aparte
Route::put('/user/update/{id}',[AreaController::class, 'update'])->name('updateUser');

//Route::get('album/{id}/{nombre}', [AlbumController::class, 'show'])->middleware(['auth', 'verified'])->name('verAlbum');
Route::get('/album/{album}/{nombre}', [AlbumController::class, 'mostrarAlbum'])->name('verAlbum');
Route::get('/autor/{autor}/{nombre}', [AutorController::class, 'mostrarAutor'])->name('verAutor');

Route::get('/album/pagination', [AlbumController::class, 'pagination'])->name('paginAlbum');
Route::get('/autor/pagination', [AutorController::class, 'pagination'])->name('paginAutor');

Route::get('/album/{id}',[AlbumController::class, 'albumRaw'])->name('albumRaw');
Route::get('/ajax-autocomplete-search', [AlbumController::class, 'selectSearch'])->name('albumAuto');

Route::get('/tablas/album', [AdminController::class, 'album'])->name('adminAlbum');
Route::get('/tablas/autor', [AdminController::class, 'autor'])->name('adminAutor');
Route::get('/tablas/music', [AdminController::class, 'musica'])->name('adminMusic');
Route::get('/tablas/genero', [AdminController::class, 'genero'])->name('adminGenero');
Route::get('/tablas/user', [AdminController::class, 'user'])->name('adminUser');

Route::get('/user/{id}/{user}/playlist', [AreaController::class, 'playlist'])->name('playlistUser');
Route::get('/user/{id}/{user}/area', [AreaController::class, 'inicioUser'])->name('areaUser');

Route::post('/formNegocios', [ContactoController::class, 'formNegocios'])->name('formNegocios');
Route::post('/formAdd', [ContactoController::class, 'formAdd'])->name('formAdd');
Route::post('/formDelete', [ContactoController::class, 'formDelete'])->name('formDelete');
Route::post('/formOtros', [ContactoController::class, 'formOtros'])->name('formOtros');
require __DIR__.'/auth.php';
