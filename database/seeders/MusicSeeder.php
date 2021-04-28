<?php

namespace Database\Seeders;

use App\Models\Music;
use Illuminate\Database\Seeder;

class MusicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Music::create([
            'nombre'=>'The legend of Hourai',
            'descripcion'=>'La legenda nunca contada',
            'album_id'=>'1',
        ]);
        Music::create([
            'nombre'=>'Default',
            'descripcion'=>'Musica por defecto',
            'album_id'=>'0',
        ]);
    }
}
