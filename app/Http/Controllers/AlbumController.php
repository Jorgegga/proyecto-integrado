<?php

namespace App\Http\Controllers;

use App\Models\{Album, Music, Genero};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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
        if (!auth()->check() || auth()->user()->permisos != 0) {
            return redirect()->action([InicioController::class, 'index']);
        }
        try {
            $request->validate([
                'nombre' => ['required', 'string'],
                'descripcion' => ['required', 'string'],
                'autor' => ['required', 'integer'],
                'genero' => ['required', 'integer']
            ]);

            $album = new Album();
            $album->nombre = ucwords($request->nombre);
            $album->descripcion = ucwords($request->descripcion);
            $album->autor_id = $request->autor;
            $album->genero_id = $request->genero;


            if ($request->has('foto')) {
                $request->validate([
                    'foto' => ['image']
                ]);
                $archivoImagen = $request->file('foto');
                $ruta = "/img/album/" . uniqid() . "_" . $archivoImagen->getClientOriginalName();
                Storage::Disk('public')->put($ruta, File::get($archivoImagen));
                $album->portada = 'storage' . $ruta;
            }

            $album->save();
            return redirect()->route('admins.index', 'tabla=album')->with("mensaje", "Album guardado correctamente");
        } catch (\Exception $ex) {
            return redirect()->route('admins.index', 'tabla=album')->with("error", "Error al crear al album" . $ex->getMessage());
        }
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
        if (!auth()->check() || auth()->user()->permisos != 0) {
            return redirect()->action([InicioController::class, 'index']);
        }

        try {
            if($album->id == 0){
            return redirect()->route('admins.index', 'tabla=album')->with("error", "Error al actualizar el album, el default no se puede modificar");
            }
            $request->validate([
                'nombre' => ['required', 'string'],
                'descripcion' => ['required', 'string'],
                'autor' => ['required', 'integer'],
                'genero' => ['required', 'integer']
            ]);


            if ($request->has('foto')) {
                $request->validate([
                    'foto' => ['image']
                ]);

                $archivoImagen = $request->file('foto');
                $ruta = "/img/album/" . uniqid() . "_" . $archivoImagen->getClientOriginalName();
                if (basename($album->portada) != "default.png") {
                    unlink($album->portada);
                }
                Storage::Disk('public')->put($ruta, File::get($archivoImagen));
                $album->update(['portada' => 'storage' . $ruta]);
            }

            $album->update([
                'nombre' => ucwords($request->nombre),
                'descripcion' => ucfirst($request->descripcion),
                'autor_id' => $request->autor,
                'genero_id' => $request->genero
            ]);
            return redirect()->route('admins.index', 'tabla=album')->with("mensaje", "Album actualizado correctamente");
        } catch (\Exception $ex) {
            return redirect()->route('admins.index', 'tabla=album')->with("error", "Error al actualizar el album " . $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        if (!auth()->check() || auth()->user()->permisos != 0) {
            return redirect()->action([InicioController::class, 'index']);
        }
        try {
            if($album->id == 0){
                return redirect()->route('admins.index', 'tabla=album')->with("error", "Error al actualizar el album, el default no se puede modificar");
                }
            if (basename($album->portada) != "default.png") {
                unlink($album->portada);
            }
            $album->delete();
            return redirect()->route('admins.index', 'tabla=album')->with("mensaje", "Album borrado correctamente");
        } catch (\Exception $ex) {
            return redirect()->route('admins.index', 'album')->with("error", "Error al borrar el album" . $ex->getMessage());
        }
    }

    public function mostrarAlbum(Album $album, $nombre)
    {
        $musica = Music::where('album_id', '=', $album->id)->orderBy('numCancion', 'asc')->get();
        return view('album.albumdetalles', compact('musica', 'album'));
    }

    public function pagination(Request $request)
    {
        $album = Album::orderBy('id', 'DESC')->Genero($request->tematica)->paginate(9);
        return view('album.pagination', compact('album'));
    }

    public function selectSearch(Request $request)
    {
        $movies = [];
        if ($request->has('q')) {
            $search = $request->q;
            $movies = Album::select("id", "nombre")
                ->where('nombre', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($movies);
    }
}
