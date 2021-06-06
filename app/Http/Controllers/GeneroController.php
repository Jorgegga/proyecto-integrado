<?php

namespace App\Http\Controllers;

use App\Models\{Genero, Album, Autor, Music};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class GeneroController extends Controller
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
        if (!auth()->check() || auth()->user()->permisos != 0) {
            return redirect()->action([InicioController::class, 'index']);
        }
        try {
            $request->validate([
                'nombre' => ['required', 'string'],
            ]);
            $music = new Genero();
            $music->nombre = ucwords($request->nombre);

            if ($request->has('foto')) {
                $request->validate([
                    'foto' => ['image']
                ]);
                $archivoImagen = $request->file('foto');
                $ruta = "/img/genero/" . uniqid() . "_" . $archivoImagen->getClientOriginalName();
                Storage::Disk('public')->put($ruta, File::get($archivoImagen));
                $music->portada = 'storage' . $ruta;
            }

            $music->save();
            return redirect()->route('admins.index', 'tabla=genero')->with("mensaje", "Género guardado correctamente");
        } catch (\Exception $ex) {
            return redirect()->route('admins.index', 'tabla=genero')->with("error", "Error al crear el genero" . $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Genero  $genero
     * @return \Illuminate\Http\Response
     */
    public function show(Genero $genero)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Genero  $genero
     * @return \Illuminate\Http\Response
     */
    public function edit(Genero $genero)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Genero  $genero
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Genero $genero)
    {
        if (!auth()->check() || auth()->user()->permisos != 0) {
            return redirect()->action([InicioController::class, 'index']);
        }
        try {
            if($genero->id == 1){
                return redirect()->route('admins.index', 'tabla=genero')->with("error", "Error al actualizar el genero, el default no es modificable");
            }
            $request->validate([
                'nombre' => ['required', 'string'],
            ]);

            if ($request->has('foto')) {
                $request->validate([
                    'foto' => ['image']
                ]);

                $archivoImagen = $request->file('foto');
                $ruta = "/img/genero/" . uniqid() . "_" . $archivoImagen->getClientOriginalName();
                if (basename($genero->portada) != "default.png") {
                    unlink($genero->portada);
                }
                Storage::Disk('public')->put($ruta, File::get($archivoImagen));
                $genero->update(['portada' => 'storage'.$ruta]);

            }

            $genero->update([
                'nombre' => ucwords($request->nombre),
            ]);
            return redirect()->route('admins.index', 'tabla=genero')->with("mensaje", "Genero actualizado correctamente");
        } catch (\Exception $ex) {
            return redirect()->route('admins.index', 'tabla=genero')->with("error", "Error al actualizar el genero " . $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Genero  $genero
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genero $genero)
    {
        if (!auth()->check() || auth()->user()->permisos != 0) {
            return redirect()->action([InicioController::class, 'index']);
        }
        try {
            if($genero->id == 1){
                return redirect()->route('admins.index', 'tabla=genero')->with("error", "Error al actualizar el genero, el default no es modificable");
            }
            if (basename($genero->portada) != "default.png") {
                unlink($genero->portada);
            }
            $genero->delete();
            $albumDefault = Album::whereNull('genero_id')->get();
            $autorDefault = Autor::whereNull('genero_id')->get();
            $musicDefault = Music::whereNull('genero_id')->get();
            foreach($albumDefault as $item){
                $item->genero_id = "1";
                $item->update();
            }
            foreach($autorDefault as $item){
                $item->genero_id = "1";
                $item->update();
            }
            foreach($musicDefault as $item){
                $item->genero_id = "1";
                $item->update();
            }
            return redirect()->route('admins.index', 'tabla=genero')->with("mensaje", "Genero borrado correctamente");
        } catch (\Exception $ex) {
            return redirect()->route('admins.index', 'tabla=genero')->with("error", "Error al borrar la canción" . $ex->getMessage());
        }
    }
}
