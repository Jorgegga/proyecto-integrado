<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\{Music, Album};
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
/*Route::get('musics', function () {

    return datatables()
        ->eloquent(Music::query())
        ->editColumn('album_id', function($item){
            $parrafo = '<a href="'.route('verAlbum',['album' => $item->album->id, 'nombre' => $item->album->nombre]).'">'.$item->album->nombre.'</a>';
            return $parrafo;
        })
        ->editColumn('autor_id', function($item){
            $parrafo = '<a href="'.route('verAutor', ['autor' => $item->autor->id, 'nombre' => $item->autor->nombre]).'">'. $item->autor->nombre .'</a>';
            return $parrafo;
        })
        ->editColumn('genero_id', function($item){
            return $item->genero->nombre;
        })
        ->editColumn('ruta', function($item){
            $parrafo = '<div class="audioExample"><audio preload="none" id="'. $item->id .'"
            onplay="parar(this.id)" onended="siguiente(this.id)">
            <source src="'.asset($item->ruta).'" type="audio/ogg">
            <source src="'.asset($item->ruta).'" type="audio/mp3">
            No lo soporta
        </audio></div>';
        return $parrafo;
        })
        ->editColumn('añadir', function($item){
            $parrafo = '
            @if ($playMusic->musicExist(Auth::user(), $item->id) == 0)
                <form method="POST"
                    action="route('playlists.store', ['user' => Auth::user()->id, 'music' => $item->id])"
                    id="anadirPlaylist $item->id "
                    onsubmit="submitForm(event,  $item->id )">
                    @csrf
                    <button id="btn $item->id " type="submit"
                        title="Añadir a tu playlist"><i class="fas fa-plus"></i></button>
                </form>
            @else
                <button type="submit" title="Ya esta en tu playlist" disabled><i
                        class="fas fa-plus"></i></button>
            @endif';
        return $parrafo;
        })
        ->rawColumns(['album_id', 'autor_id', 'genero_id', 'ruta', 'añadir'])->toJson();
});*/
