<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if (!auth()->check()) {
            return redirect()->back();
        }
        if(auth()->user()->id != $request->user_id){
            return redirect()->back();
        }
        try {
            $request->validate([
                'user' => ['required', 'integer'],
                'music' => ['required', 'integer'],
            ]);

            $repetido = Playlist::where('user_id', $request->user)->where('music_id', $request->music)->first();
            if($repetido != null){
                return redirect()->action([MusicController::class, 'index']);
            }
            $playlist = new Playlist();
            $playlist->user_id = $request->user;
            $playlist->music_id = $request->music;

            $playlist->save();
            return redirect()->route('musics.index')->with("mensaje", "Canción guardada correctamente");
        } catch (\Exception $ex) {
            return redirect()->route('musics.index')->with("error", "Error al añadir la creación" . $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Playlist  $playlist
     * @return \Illuminate\Http\Response
     */
    public function show(Playlist $playlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Playlist  $playlist
     * @return \Illuminate\Http\Response
     */
    public function edit(Playlist $playlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Playlist  $playlist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Playlist $playlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Playlist  $playlist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Playlist $playlist)
    {
        try {
            if (!auth()->check()) {
                return redirect()->back();
            }
            if(auth()->user()->id != $playlist->user_id){
                return redirect()->back();
            }
            $playlist->delete();
            return back()->with("mensaje", "Canción borrada");
        } catch (\Exception $ex) {
            return back()->with("error", "Error al borrar la canción" . $ex->getMessage());
        }
    }
}
