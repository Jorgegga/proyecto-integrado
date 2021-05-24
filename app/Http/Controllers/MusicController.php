<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Music;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class MusicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $musica = Music::orderBy('nombre')->paginate(10);
        $album = Album::orderBy('nombre')->get();
        return view('musica.musicaindex', compact('musica', 'album'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->check() || auth()->user()->permisos != 0) {
            return redirect()->action([InicioController::class, 'index']);
        }
        try {
            $request->validate([
                'nombre' => ['required', 'string'],
                'descripcion' => ['required', 'string'],
                'autor' => ['required', 'integer'],
                'album' => ['required', 'integer'],
                'numCancion' => ['required', 'integer'],
                'genero' => ['required', 'integer'],
            ]);
            $music = new Music();
            $music->nombre = ucwords($request->nombre);
            $music->descripcion = ucwords($request->descripcion);
            $music->autor_id = $request->autor;
            $music->album_id = $request->album;
            $music->numCancion = $request->numCancion;
            $music->genero_id = $request->genero;

            if ($request->has('foto')) {
                $request->validate([
                    'foto' => ['image']
                ]);
                $archivoImagen = $request->file('foto');
                $ruta = "/img/musica/" . uniqid() . "_" . $archivoImagen->getClientOriginalName();
                Storage::Disk('public')->put($ruta, File::get($archivoImagen));
                $music->portada = 'storage' . $ruta;
            }
            if ($request->has('ruta')) {
                $request->validate([
                    'ruta' => ['mimes:mp3, ogg, opus, oga']
                ]);
                $archivoMusic = $request->file('ruta');
                $ruta = "/music/" . uniqid() . "_" . $archivoMusic->getClientOriginalName();
                Storage::Disk('public')->put($ruta, File::get($archivoMusic));
                $music->ruta = 'storage' . $ruta;
            }

            $music->save();
            return redirect()->route('admins.index', 'tabla=music')->with("mensaje", "Canción guardada correctamente");
        } catch (\Exception $ex) {
            return redirect()->route('admins.index', 'tabla=music')->with("error", "Error al crear la canción " . $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function show(Music $music)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function edit(Music $music)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Music $music)
    {
        if (!auth()->check() || auth()->user()->permisos != 0) {
            return redirect()->action([InicioController::class, 'index']);
        }
        try {
            $request->validate([
                'nombre' => ['required', 'string'],
                'descripcion' => ['required', 'string'],
                'autor' => ['required', 'integer'],
                'album' => ['required', 'integer'],
                'numCancion' => ['required', 'integer'],
                'genero' => ['required', 'integer'],
            ]);

            if ($request->has('foto')) {
                $request->validate([
                    'foto' => ['image']
                ]);

                $archivoImagen = $request->file('foto');
                $ruta = "/img/musica/" . uniqid() . "_" . $archivoImagen->getClientOriginalName();
                if (basename($music->portada) != "default.png") {
                    unlink($music->portada);
                }
                Storage::Disk('public')->put($ruta, File::get($archivoImagen));
                $music->update(['portada' => 'storage' . $ruta]);
            }

            if ($request->has('ruta')) {
                $request->validate([
                    'ruta' => ['mimes:mp3, ogg, opus, oga']
                ]);
                $archivoMusic = $request->file('ruta');
                $ruta = "/music/" . uniqid() . "_" . $archivoMusic->getClientOriginalName();
                if (basename($music->ruta) != "default.ogg") {
                    unlink($music->ruta);
                }
                Storage::Disk('public')->put($ruta, File::get($archivoMusic));
                $music->update(['ruta' => 'storage' . $ruta]);
            }

            $music->update([
                'nombre' => ucwords($request->nombre),
                'descripcion' => ucwords($request->descripcion),
                'autor_id' => $request->autor,
                'album_id' => $request->album,
                'numCancion' => $request->numCancion,
                'genero_id' => $request->genero,
            ]);
            $music->update();
            return redirect()->route('admins.index', 'tabla=music')->with("mensaje", "Cancion actualizado correctamente");
        } catch (\Exception $ex) {
            return redirect()->route('admins.index', 'tabla=music')->with("error", "Error al actualizar el cancion" . $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function destroy(Music $music)
    {
        if (!auth()->check() || auth()->user()->permisos != 0) {
            return redirect()->action([InicioController::class, 'index']);
        }
        try {
            if (basename($music->portada) != "default.png") {
                unlink($music->portada);
            }
            if (basename($music->ruta) != "default.ogg"){
                unlink($music->ruta);
            }
            $music->delete();
            return redirect()->route('admins.index', 'tabla=music')->with("mensaje", "Canción borrada correctamente");
        } catch (\Exception $ex) {
            return redirect()->route('admins.index', 'tabla=music')->with("error", "Error al borrar la canción" . $ex->getMessage());
        }
    }
}
