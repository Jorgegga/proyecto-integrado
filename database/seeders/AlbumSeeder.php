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
            'nombre'=>"Otros"
        ]);
        Album::create([
            'nombre'=>"Dolls in Pseudo Paradaise",
            'descripcion'=>"A veces el paraiso no es lo que parece...",
            'autor'=>"Zun",
            'portada'=>"/storage/img/album/dolls.png",
        ]);
        Album::create([
            'nombre'=>"Ghostly Field Club",
            'descripcion'=>"",
            'autor'=>"Zun",
            'portada'=>"/storage/img/album/ghostly.png",
        ]);
        Album::create([
            'nombre'=>"Magical Astronomy",
            'descripcion'=>"Descrubre la luna",
            'autor'=>"Zun",
            'portada'=>"/storage/img/album/magical.png",
        ]);
        Album::create([
            'nombre'=>"Trojan Green Asteroid",
            'descripcion'=>"¿Hay acaso un templo en ese meteorito?",
            'autor'=>"Zun",
            'portada'=>"/storage/img/album/trojan.png",
        ]);
        Album::create([
            'nombre'=>"Dateless Bar Old Adam",
            'descripcion'=>"Un bar perdido en el tiempo...",
            'autor'=>"Zun",
            'portada'=>"/storage/img/album/dateless.png",
        ]);
        Album::create([
            'nombre'=>"The Grimoire of Marisa",
            'descripcion'=>"Los grimorios pueden ser una gran fuente de fuerza",
            'autor'=>"Zun",
            'portada'=>"/storage/img/album/grimoire.png",
        ]);
        Album::create([
            'nombre'=>"Retrospective 53 minutes",
            'descripcion'=>"Un viaje de 53 minutos a lo desconocido",
            'autor'=>"Zun",
            'portada'=>"/storage/img/album/retrospective.png",
        ]);
    }
}
