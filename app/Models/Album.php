<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;
    protected $fillable=['nombre', 'descripcion', 'autor_id', 'portada'];

    public function music(){
        return $this->hasMany(Music::class);
    }

    public function autor(){
        return $this->belongsTo(Autor::class);
    }

    public function numTemas($id){
        $contar = Music::where('album_id', '=', $id)->count();
        return $contar;
    }

    public function nomAutor($id){
        $nombre = Autor::select('nombre')->where('id', $id)->get()->first();
        return $nombre->nombre;
    }

}
