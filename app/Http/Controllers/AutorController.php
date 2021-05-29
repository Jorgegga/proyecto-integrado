<?php

namespace App\Http\Controllers;

use App\Models\{Autor, Album, Music};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AutorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $autor = Autor::orderBy('nombre')->paginate(5);
        return (view('autor.autorindex', compact('autor')));
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
                'genero' => ['required', 'integer']
            ]);

            $autor = new Autor();
            $autor->nombre = ucwords($request->nombre);
            $autor->genero_id = $request->genero;

            if ($request->has('descripcion') && $request->descripcion != null) {
                $request->validate([
                    'descripcion' => ['string'],
                ]);
                $autor->descripcion = ucwords($request->descripcion);
            }

            if ($request->has('foto')) {
                $request->validate([
                    'foto' => ['image']
                ]);
                $archivoImagen = $request->file('foto');
                $ruta = "/img/autor/" . uniqid() . "_" . $archivoImagen->getClientOriginalName();
                Storage::Disk('public')->put($ruta, File::get($archivoImagen));
                $autor->foto = 'storage' . $ruta;
            }
            $autor->save();
            return redirect()->route('admins.index', 'tabla=autor')->with("mensaje", "Autor guardado correctamente");
        } catch (\Exception $ex) {
            return redirect()->route('admins.index', 'tabla=autor')->with("error", "Error al crear el autor" . $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function show(Autor $autor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function edit(Autor $autor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Autor $autore)
    {
        if (!auth()->check() || auth()->user()->permisos != 0) {
            return redirect()->action([InicioController::class, 'index']);
        }
        try {
            $autor = $autore;
            if($autor->id == 0){
                return redirect()->route('admins.index', 'tabla=autor')->with("error", "Error al actualizar el autor, el default no se puede borrar");
            }
            $request->validate([
                'nombre' => ['required', 'string'],
                'genero' => ['required', 'integer']
            ]);

            if ($request->has('foto')) {
                $request->validate([
                    'foto' => ['image']
                ]);

                $archivoImagen = $request->file('foto');
                $ruta = "/img/autor/" . uniqid() . "_" . $archivoImagen->getClientOriginalName();
                if (basename($autor->foto) != "default.png") {
                    unlink($autor->foto);
                }
                Storage::Disk('public')->put($ruta, File::get($archivoImagen));
                $autor->update(['foto' => 'storage' . $ruta]);
            }

            if ($request->has('descripcion')) {
                if ($request->descripcion == null) {
                    $request->descripcion = "No se ha proporcionado ninguna descripción";
                    $autor->descripcion = $request->descripcion;
                } else {
                    $request->validate([
                        'descripcion' => ['string'],
                    ]);
                    $autor->descripcion = ucwords($request->descripcion);
                }
                $autor->update(['descripcion' => $request->descripcion,]);
            }

            $autor->update([
                'nombre' => ucwords($request->nombre),
                'genero_id' => $request->genero,
            ]);
            return redirect()->route('admins.index', 'tabla=autor')->with("mensaje", "Autor actualizado correctamente");
        } catch (\Exception $ex) {
            return redirect()->route('admins.index', 'tabla=autor')->with("error", "Error al actualizar el autor " . $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Autor $autore)
    {
        if (!auth()->check() || auth()->user()->permisos != 0) {
            return redirect()->action([InicioController::class, 'index']);
        }
        try {
            if($autore->id == 0){
                return redirect()->route('admins.index', 'tabla=autor')->with("error", "Error al actualizar el autor, el default no se puede borrar");
            }
            if (basename($autore->foto) != "default.png") {
                unlink($autore->foto);
            }
            $autore->delete();
            return redirect()->route('admins.index', 'tabla=autor')->with("mensaje", "Autor borrado correctamente");
        } catch (\Exception $ex) {
            return redirect()->route('admins.index', 'tabla=autor')->with("error", "Error al borrar el autor" . $ex->getMessage());
        }
    }

    public function mostrarAutor(Autor $autor, $nombre)
    {
        $album = Album::where('autor_id', '=', $autor->id)->orderBy('created_at', 'desc')->get();
        return view('autor.autordetalles', compact('album', 'autor'));
    }

    public function pagination()
    {
        $autor = Autor::orderBy('nombre')->paginate(5);
        return view('autor.pagination', compact('autor'));
    }

}
