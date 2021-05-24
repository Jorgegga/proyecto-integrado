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
        $album = Album::orderBy('id', 'DESC')->paginate(9);
        $genero = Genero::orderBy('id', 'asc')->get();
        $autor = Autor::orderBy('id', 'asc')->get();
        return view('administrador.adminalbum', compact('album', 'genero', 'autor'));
    }

    public function autor()
    {
        if(!auth()->check() || auth()->user()->permisos != 0){
            return redirect()->action([InicioController::class, 'index']);
        }
        $autor = Autor::orderBy('id', 'DESC')->paginate(9);
        $genero = Genero::orderBy('id', 'asc')->get();
        return view('administrador.adminautor', compact('autor', 'genero'));
    }

    public function musica(){
        if(!auth()->check() || auth()->user()->permisos != 0){
            return redirect()->action([InicioController::class, 'index']);
        }
        $music = Music::orderBy('nombre')->paginate(9);
        $album = Album::orderBy('nombre')->get();
        $genero = Genero::orderBy('id', 'asc')->get();
        $autor = Autor::orderBy('id', 'asc')->get();
        return view('administrador.adminmusic', compact('music', 'album', 'autor', 'genero'));
    }

    public function genero(){
        if(!auth()->check() || auth()->user()->permisos != 0){
            return redirect()->action([InicioController::class, 'index']);
        }
        $genero = Genero::orderBy('id', 'desc')->paginate(9);
        return view('administrador.admingenero', compact('genero'));
    }

    public function user(){
        if(!auth()->check() || auth()->user()->permisos != 0){
            return redirect()->action([InicioController::class, 'index']);
        }
        $user = User::orderBy('permisos', 'asc')->paginate(9);
        return view('administrador.adminuser', compact('user'));
    }
}
