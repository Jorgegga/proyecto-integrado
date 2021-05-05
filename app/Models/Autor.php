<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;

    protected $fillable=['nombre', 'descripcion', 'foto'];

    public function album(){
        return $this->hasMany(Album::class);
    }

    public function nomAutor($id){
        $consulta = Album::select('autor_id')->where('id', $id)->get()->first();
        $consulta = Autor::select('nombre')->where('id', $consulta->autor_id)->get()->first();
        return $consulta->nombre;
    }

    public function autMusic($id){
        $consulta = Music::where('album_id','=', $id)->orderBy('created_at', 'desc')->paginate(5);
        return $consulta;
    }
}
