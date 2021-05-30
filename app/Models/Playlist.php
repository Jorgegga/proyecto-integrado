<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;

    protected $fillable=['user_id', 'music_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function music(){
        return $this->belongsTo(Music::class);
    }

    public function musicExist($user, $id){
        $contar = Playlist::where('user_id', $user->id)->where('music_id', $id)->get()->count();
        return $contar;
    }
}
