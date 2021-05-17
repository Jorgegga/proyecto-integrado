<?php

namespace App\Http\Controllers;

use App\Models\{Album, Music, Genero};
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $album = Album::orderBy('id', 'DESC')->Genero($request->tematica)->paginate(9);
        $music = Music::orderBy('album_id');
        $genero = Genero::orderBy('id', 'desc')->get();
        $this->pagination($request);
        return view('album.albumindex', compact('album', 'music', 'genero', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        //
    }

    public function mostrarAlbum(Album $album, $nombre)
    {
        $musica = Music::where('album_id', '=', $album->id)->orderBy('numCancion', 'asc')->get();
        return view('album.albumdetalles', compact('musica','album'));
    }

    public function pagination(Request $request){
        $album = Album::orderBy('id', 'DESC')->Genero($request->tematica)->paginate(9);
        return view('album.pagination', compact('album'));
    }

    public function selectSearch(Request $request)
    {
    	$movies = [];
        if($request->has('q')){
            $search = $request->q;
            $movies =Album::select("id", "nombre")
            		->where('nombre', 'LIKE', "%$search%")
            		->get();
        }
        return response()->json($movies);
    }

}
