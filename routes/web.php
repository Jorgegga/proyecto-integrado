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
    return redirect()->route('inicios.index');
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

//Route::get('album/{id}/{nombre}', [AlbumController::class, 'show'])->middleware(['auth', 'verified'])->name('verAlbum');
Route::get('/album/{album}/{nombre}', [AlbumController::class, 'mostrarAlbum'])->name('verAlbum');
Route::get('/autor/{autor}/{nombre}', [AutorController::class, 'mostrarAutor'])->name('verAutor');

Route::get('/album/pagination', [AlbumController::class, 'pagination'])->name('paginAlbum');
Route::get('/autor/pagination', [AutorController::class, 'pagination'])->name('paginAutor');

Route::get('/album/{id}',[AlbumController::class, 'albumRaw'])->name('albumRaw');

Route::get('/albumAdminUpdate/{id}',[AdminController::class, 'albumRawUpdate'])->middleware('auth')->name('albumRawUpdate');
Route::get('/albumAdminDetalles/{id}',[AdminController::class, 'albumRawDetalles'])->middleware('auth')->name('albumRawDetalles');
Route::get('/autorAdminUpdate/{id}',[AdminController::class, 'autorRawUpdate'])->middleware('auth')->name('autorRawUpdate');
Route::get('/autorAdminDetalles/{id}',[AdminController::class, 'autorRawDetalles'])->middleware('auth')->name('autorRawDetalles');
Route::get('/musicAdminUpdate/{id}',[AdminController::class, 'musicRawUpdate'])->middleware('auth')->name('musicRawUpdate');
Route::get('/musicAdminDetalles/{id}',[AdminController::class, 'musicRawDetalles'])->middleware('auth')->name('musicRawDetalles');
Route::get('/generoAdminUpdate/{id}',[AdminController::class, 'generoRawUpdate'])->middleware('auth')->name('generoRawUpdate');
Route::get('/generoAdminDetalles/{id}',[AdminController::class, 'generoRawDetalles'])->middleware('auth')->name('generoRawDetalles');
Route::get('/userAdminUpdate/{id}',[AdminController::class, 'userRawUpdate'])->middleware('auth')->name('userRawUpdate');
Route::get('/userAdminDetalles/{id}',[AdminController::class, 'userRawDetalles'])->middleware('auth')->name('userRawDetalles');

Route::get('/autocompleteAlbum', [AlbumController::class, 'selectSearch'])->name('albumAuto');
Route::get('/autocompleteAutor', [AutorController::class, 'selectSearch'])->name('autorAuto');

Route::get('/tablas/album', [AdminController::class, 'album'])->middleware('auth')->name('adminAlbum');
Route::get('/tablas/autor', [AdminController::class, 'autor'])->middleware('auth')->name('adminAutor');
Route::get('/tablas/music', [AdminController::class, 'musica'])->middleware('auth')->name('adminMusic');
Route::get('/tablas/genero', [AdminController::class, 'genero'])->middleware('auth')->name('adminGenero');
Route::get('/tablas/user', [AdminController::class, 'user'])->middleware('auth')->name('adminUser');

Route::put('/user/update/{id}',[AreaController::class, 'update'])->middleware('auth')->name('updateUser');
Route::get('/user/{id}/{user}/playlist', [AreaController::class, 'playlist'])->middleware('auth')->name('playlistUser');
Route::get('/user/{id}/{user}/area', [AreaController::class, 'inicioUser'])->middleware('auth')->name('areaUser');

//Route formularios correos
Route::post('/formNegocios', [ContactoController::class, 'formNegocios'])->name('formNegocios');
Route::post('/formAdd', [ContactoController::class, 'formAdd'])->name('formAdd');
Route::post('/formDelete', [ContactoController::class, 'formDelete'])->name('formDelete');
Route::post('/formOtros', [ContactoController::class, 'formOtros'])->name('formOtros');

require __DIR__.'/auth.php';
