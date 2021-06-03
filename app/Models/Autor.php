<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;

    protected $fillable=['nombre', 'descripcion', 'foto', 'genero_id'];

    public function album(){
        return $this->hasMany(Album::class);
    }

    public function music(){
        return $this->hasMany(Music::class);
    }

    public function genero(){
        return $this->belongsTo(Genero::class);
    }

    public function scopeGenero($query, $generos){
        if($generos == null || $generos == "%"){
            return $query->where("genero_id", "like", "%");
        }else{
            return $query->where("genero_id", "=", $generos);
        }
    }

    public function scopeLivesearch($query, $livesearch){
        if($livesearch == null || $livesearch == "%"){
            return $query->where("id", "like", "%");
        }else{
            return $query->where("id", "=", $livesearch);
        }
    }

    public function nomAutor($id){
        $consulta = Album::select('autor_id')->where('id', $id)->get()->first();
        $consulta = Autor::select('nombre')->where('id', $consulta->autor_id)->get()->first();
        return $consulta->nombre;
    }

    public function autorComp($id){
        $consulta = Album::select('autor_id')->where('id', $id)->get()->first();
        $consulta = Autor::where('id', $consulta->autor_id)->get()->first();
        return $consulta;
    }

    public function autMusic($id){
        $consulta = Music::where('autor_id','=', $id)->orderBy('created_at', 'desc')->paginate(8);
        return $consulta;
    }


}
