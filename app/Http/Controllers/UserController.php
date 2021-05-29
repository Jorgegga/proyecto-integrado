<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
                'email' =>['required', 'email'],
                'pass' => ['required', 'string'],
                'permisos' => ['required','integer','min:0','max:1'],
            ]);
            $user = new User();
            $user->name = ucwords($request->nombre);
            $user->email = $request->email;
            $user->password = Hash::make($request->pass);
            $user->permisos = $request->permisos;

            if ($request->has('foto')) {
                $request->validate([
                    'foto' => ['image']
                ]);
                $archivoImagen = $request->file('foto');
                $ruta = "/img/user/" . uniqid() . "_" . $archivoImagen->getClientOriginalName();
                Storage::Disk('public')->put($ruta, File::get($archivoImagen));
                $user->foto = 'storage' . $ruta;
            }

            $user->save();
            return redirect()->route('admins.index', 'tabla=user')->with("mensaje", "Usuario guardado correctamente");
        } catch (\Exception $ex) {
            return redirect()->route('admins.index', 'tabla=user')->with("error", "Error al crear el usuario " . $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $genero
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if (!auth()->check() || auth()->user()->permisos != 0) {
            return redirect()->action([InicioController::class, 'index']);
        }
        try {
            if($user->id == 1){
                return redirect()->route('admins.index', 'tabla=user')->with("error", "Error al actualizar el usuario, el default no es modificable");
            }
            $request->validate([
                'nombre' => ['required', 'string'],
                'email' =>['required', 'email'],
                'permisos' => ['required', 'integer', 'min:0', 'max:1'],
            ]);

            if($request->pass != null){
                dd($request);
                $request->validate([
                    'pass' => ['string'],
                ]);
                $user->update(['password' => Hash::make($request->pass)]);
            }

            if ($request->has('foto')) {
                $request->validate([
                    'foto' => ['image']
                ]);

                $archivoImagen = $request->file('foto');
                $ruta = "/img/user/" . uniqid() . "_" . $archivoImagen->getClientOriginalName();
                if (basename($user->foto) != "default.png") {
                    unlink($user->foto);
                }
                Storage::Disk('public')->put($ruta, File::get($archivoImagen));
                $user->update(['foto' => 'storage'.$ruta]);

            }

            $user->update([
                'name' => ucwords($request->nombre),
                'email' => $request->email,
                'permisos' => $request->permisos,
            ]);
            return redirect()->route('admins.index', 'tabla=user')->with("mensaje", "Usuario actualizado correctamente");
        } catch (\Exception $ex) {
            return redirect()->route('admins.index', 'tabla=user')->with("error", "Error al actualizar el usuario " . $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (!auth()->check() || auth()->user()->permisos != 0) {
            return redirect()->action([InicioController::class, 'index']);
        }
        try {
            if($user->id == 1){
                return redirect()->route('admins.index', 'tabla=user')->with("error", "Error al actualizar el usuario, el default no es modificable");
            }
            if (basename($user->foto) != "default.png") {
                unlink($user->foto);
            }
            $user->delete();
            return redirect()->route('admins.index', 'tabla=user')->with("mensaje", "Usuario borrado correctamente");
        } catch (\Exception $ex) {
            return redirect()->route('admins.index', 'tabla=user')->with("error", "Error al borrar el usuario" . $ex->getMessage());
        }
    }
}
