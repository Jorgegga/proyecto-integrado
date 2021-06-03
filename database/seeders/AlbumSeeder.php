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
            'nombre'=>"Otros",
            'portada'=>"storage/img/album/disco.png",
            'autor_id'=>"0",
            'genero_id'=>"6",
        ]);
        Album::create([
            'nombre'=>"Dolls in Pseudo Paradaise",
            'descripcion'=>"A veces el paraiso no es lo que parece...",
            'autor_id'=>"1",
            'portada'=>"storage/img/album/dolls.png",
            'genero_id'=>"6",
        ]);
        Album::create([
            'nombre'=>"Ghostly Field Club",
            'descripcion'=>"",
            'autor_id'=>"1",
            'portada'=>"storage/img/album/ghostly.png",
            'genero_id'=>"6",
        ]);
        Album::create([
            'nombre'=>"Magical Astronomy",
            'descripcion'=>"Descrubre la luna",
            'autor_id'=>"1",
            'portada'=>"storage/img/album/magical.png",
            'genero_id'=>"6",
        ]);
        Album::create([
            'nombre'=>"Trojan Green Asteroid",
            'descripcion'=>"¿Hay acaso un templo en ese meteorito?",
            'autor_id'=>"1",
            'portada'=>"storage/img/album/trojan.png",
            'genero_id'=>"6",
        ]);
        Album::create([
            'nombre'=>"Dateless Bar Old Adam",
            'descripcion'=>"Un bar perdido en el tiempo...",
            'autor_id'=>"1",
            'portada'=>"storage/img/album/dateless.png",
            'genero_id'=>"6",
        ]);
        Album::create([
            'nombre'=>"The Grimoire of Marisa",
            'descripcion'=>"Los grimorios pueden ser una gran fuente de fuerza",
            'autor_id'=>"3",
            'portada'=>"storage/img/album/grimoire.png",
            'genero_id'=>"6",
        ]);
        Album::create([
            'nombre'=>"Retrospective 53 minutes",
            'descripcion'=>"Un viaje de 53 minutos a lo desconocido",
            'autor_id'=>"3",
            'portada'=>"storage/img/album/retrospective.png",
            'genero_id'=>"6",
        ]);
    }
}
