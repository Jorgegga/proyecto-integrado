<?php

namespace Database\Seeders;

use App\Models\Album;
use Illuminate\Database\Seeder;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Album::create([
            'id'=>0,
            'nombre'=>"Default"
        ]);
        Album::create([
            'nombre'=>"Dolls in Pseudo Paradaise",
            'descripcion'=>"A veces el paraiso no es lo que parece...",
            'autor'=>"Zun"
        ]);
        Album::create([
            'nombre'=>"Ghostly Field Club",
            'descripcion'=>"",
            'autor'=>"Zun"
        ]);
        Album::create([
            'nombre'=>"Magical Astronomy",
            'descripcion'=>"Descrubre la luna",
            'autor'=>"Zun"
        ]);
        Album::create([
            'nombre'=>"Troyan Green Asteroid",
            'descripcion'=>"¿Hay acaso un templo en ese meteorito?",
            'autor'=>"Zun"
        ]);
        Album::create([
            'nombre'=>"Dateless Bar Old Adam",
            'descripcion'=>"Un bar perdido en el tiempo...",
            'autor'=>"Zun"
        ]);
        Album::create([
            'nombre'=>"The Grimoire of Marisa",
            'descripcion'=>"Los grimorios pueden ser una gran fuente de fuerza",
            'autor'=>"Zun"
        ]);
    }
}
