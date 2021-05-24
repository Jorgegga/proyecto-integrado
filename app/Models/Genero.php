<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    use HasFactory;

    protected $fillable=['nombre'];

    public function album(){
        return $this->hasMany(Album::class);
    }

    public function autor(){
        return $this->hasMany(Autor::class);
    }

    public function music(){
        return $this->hasMany(Music::class);
    }

    public function nomGenero($id){
        $nom = Genero::select('nombre')->where('id', $id)->get()->first()->nombre;
        return $nom;
    }
}
