<?php

namespace App\Http\Controllers;

use App\Models\{Album, Music, Genero, User, Playlist};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AreaController extends Controller
{
    public function playlist($id, $user){
        $playlist = Playlist::where('user_id', $id)->orderBy('created_at', 'DESC')->paginate(10);
        $user = User::where('id', $id)->get()->first();
        return view('user.userplaylist', compact('playlist', 'user'));
    }

    public function inicioUser($id, $user){
        $user = User::where('id', $id)->get()->first();
        return view('user.userinicio', compact('user'));
    }


}
