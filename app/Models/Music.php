<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    use HasFactory;

    protected $fillable=['nombre', 'descripcion', 'autor', 'album_id', 'portada', 'ruta', 'numCancion'];

    public function album(){
        return $this->belongsTo(Album::class);
    }
}
