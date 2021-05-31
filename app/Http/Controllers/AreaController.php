<?php

namespace App\Http\Controllers;

use App\Models\{Album, Music, Genero, User, Playlist};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AreaController extends Controller
{
    public function playlist($id, $user){
        if (!auth()->check()) {
            return redirect()->back();
        }
        if(auth()->user()->id != $id){
            return redirect()->back();
        }
        $playlist = Playlist::where('user_id', $id)->orderBy('created_at', 'DESC')->paginate(10);
        $user = User::where('id', $id)->get()->first();
        return view('user.userplaylist', compact('playlist', 'user'));
    }

    public function inicioUser($id, $user){
        if (!auth()->check()) {
            return redirect()->back();
        }
        if(auth()->user()->id != $id){
            return redirect()->back();
        }
        $user = User::where('id', $id)->get()->first();
        return view('user.userinicio', compact('user'));
    }

    public function update(Request $request, $id){
        if (!auth()->check()) {
            return redirect()->back();
        }
        $user = User::find($id);
        if(auth()->user()->id != $user->id){
            return redirect()->back();
        }
        try{
        $request->validate([
            "inputNombre"=>['required', 'string'],
            "inputEmail"=>['required', 'email'],
        ]);

        if($request->inputPass != null){
            $request->validate([
                'inputPass' => ['string'],
            ]);
            $user->update(['password' => Hash::make($request->inputPass)]);
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
            'name' => ucwords($request->inputNombre),
            'email' => $request->inputEmail,
        ]);

        return redirect()->back()->with("mensaje", "Tu usuario se ha actualizado correctamente");
    }catch(\Exception $ex){
        return redirect()->back()->with("mensaje", "Error al actualizar el usuario: " . $ex->getMessage());
    }
    }
}
