<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;
    protected $fillable=['nombre', 'descripcion', 'autor', 'portada'];

    public function music(){
        return $this->hasMany(Music::class);
    }
}
