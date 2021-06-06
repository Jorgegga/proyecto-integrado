<?php

namespace App\Http\Controllers;

use App\Models\{Autor, Album, Music, Genero, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!auth()->check() || auth()->user()->permisos != 0){
            return redirect()->action([InicioController::class, 'index']);
        }
        $album = Album::orderBy('id', 'DESC')->paginate(9);
        $genero = Genero::orderBy('id', 'asc')->get();
        $autor = Autor::orderBy('id', 'asc')->get();
        return view('administrador.adminindex', compact('album', 'genero', 'autor'));
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

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Autor  $autor
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
     * @param  \App\Models\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {

    }

    public function album()
    {
        if(!auth()->check() || auth()->user()->permisos != 0){
            return redirect()->action([InicioController::class, 'index']);
        }
        $album = Album::orderBy('id', 'DESC')->get();
        $genero = Genero::orderBy('id', 'asc')->get();
        $autor = Autor::orderBy('id', 'asc')->get();
        return view('administrador.adminalbum', compact('album', 'genero', 'autor'));
    }

    public function albumRawUpdate($id){
        if(!auth()->check() || auth()->user()->permisos != 0){
            return redirect()->action([InicioController::class, 'index']);
        }
        $album = Album::find($id);
        $genero = Genero::get();
        return view('administrador.raw.albumrawupdate', compact('album', 'genero'));
    }

    public function albumRawDetalles($id){
        if(!auth()->check() || auth()->user()->permisos != 0){
            return redirect()->action([InicioController::class, 'index']);
        }
        $album = Album::find($id);
        return view('administrador.raw.albumrawdetalles', compact('album'));
    }

    public function autor()
    {
        if(!auth()->check() || auth()->user()->permisos != 0){
            return redirect()->action([InicioController::class, 'index']);
        }
        $autor = Autor::orderBy('id', 'DESC')->get();
        $genero = Genero::orderBy('id', 'asc')->get();
        return view('administrador.adminautor', compact('autor', 'genero'));
    }

    public function autorRawUpdate($id){
        if(!auth()->check() || auth()->user()->permisos != 0){
            return redirect()->action([InicioController::class, 'index']);
        }
        $autor = Autor::find($id);
        $genero = Genero::get();
        return view('administrador.raw.autorrawupdate', compact('autor', 'genero'));
    }

    public function autorRawDetalles($id){
        if(!auth()->check() || auth()->user()->permisos != 0){
            return redirect()->action([InicioController::class, 'index']);
        }
        $autor = Autor::find($id);
        return view('administrador.raw.autorrawdetalles', compact('autor'));
    }

    public function musica(){
        if(!auth()->check() || auth()->user()->permisos != 0){
            return redirect()->action([InicioController::class, 'index']);
        }
        $music = Music::orderBy('nombre')->get();
        $album = Album::orderBy('nombre')->get();
        $genero = Genero::orderBy('id', 'asc')->get();
        $autor = Autor::orderBy('id', 'asc')->get();
        return view('administrador.adminmusic', compact('music', 'album', 'autor', 'genero'));
    }

    public function musicRawUpdate($id){
        if(!auth()->check() || auth()->user()->permisos != 0){
            return redirect()->action([InicioController::class, 'index']);
        }
        $music = Music::find($id);
        $genero = Genero::get();
        return view('administrador.raw.musicrawupdate', compact('music', 'genero'));
    }

    public function musicRawDetalles($id){
        if(!auth()->check() || auth()->user()->permisos != 0){
            return redirect()->action([InicioController::class, 'index']);
        }
        $music = Music::find($id);
        return view('administrador.raw.musicrawdetalles', compact('music'));
    }

    public function genero(){
        if(!auth()->check() || auth()->user()->permisos != 0){
            return redirect()->action([InicioController::class, 'index']);
        }
        $genero = Genero::orderBy('id', 'desc')->paginate(9);
        return view('administrador.admingenero', compact('genero'));
    }

    public function generoRawUpdate($id){
        if(!auth()->check() || auth()->user()->permisos != 0){
            return redirect()->action([InicioController::class, 'index']);
        }
        $genero = Genero::find($id);
        return view('administrador.raw.generorawupdate', compact('genero'));
    }

    public function generoRawDetalles($id){
        if(!auth()->check() || auth()->user()->permisos != 0){
            return redirect()->action([InicioController::class, 'index']);
        }
        $genero = Genero::find($id);
        return view('administrador.raw.generorawdetalles', compact('genero'));
    }

    public function user(){
        if(!auth()->check() || auth()->user()->permisos != 0){
            return redirect()->action([InicioController::class, 'index']);
        }
        $user = User::orderBy('permisos', 'asc')->paginate(9);
        return view('administrador.adminuser', compact('user'));
    }

    public function userRawUpdate($id){
        if(!auth()->check() || auth()->user()->permisos != 0){
            return redirect()->action([InicioController::class, 'index']);
        }
        $user = User::find($id);
        return view('administrador.raw.userrawupdate', compact('user'));
    }

    public function userRawDetalles($id){
        if(!auth()->check() || auth()->user()->permisos != 0){
            return redirect()->action([InicioController::class, 'index']);
        }
        $user = User::find($id);
        return view('administrador.raw.userrawdetalles', compact('user'));
    }
}
