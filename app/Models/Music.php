<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    use HasFactory;

    protected $fillable=['nombre', 'descripcion', 'autor_id', 'album_id','genero_id', 'portada', 'ruta', 'numCancion'];

    public function album(){
        return $this->belongsTo(Album::class);
    }

    public function autor(){
        return $this->belongsTo(Autor::class);
    }

    public function genero(){
        return $this->belongsTo(Genero::class);
    }

    public function playlist(){
        return $this->hasOne(Playlist::class);
    }

    public function nomAlbum($id){
        $alb = Album::where('id', '=', $id)->get();
        return $alb;
    }

    public function nomAutor($id){
        $aut = Autor::where('id', '=', $id)->get()->first();
        return $aut;
    }
}
