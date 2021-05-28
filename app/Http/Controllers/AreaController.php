<?php

namespace App\Http\Controllers;

use App\Models\{Album, Music, Genero, User, Playlist};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AreaController extends Controller
{
    public function playlist($id, $user){
        $playlist = Playlist::where('user_id', $id)->paginate(5);
        $user = User::where('id', $id)->get()->first();
        return view('user.userplaylist', compact('playlist', 'user'));
    }
}
