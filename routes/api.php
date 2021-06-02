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
            return '<a
            href={{route("verAlbum", [album =>'.$item->album->id.', nombre => '.$item->album->nombre.']) }}>{{ '.$item->album->nombre .'}}</a>';
        })
        ->editColumn('autor_id', function($item){
            return $item->autor->nombre;
        })
        ->editColumn('genero_id', function($item){
            return $item->genero->nombre;
        })
        ->rawColumns(['album_id', 'autor_id', 'genero_id'])->toJson();
});*/
