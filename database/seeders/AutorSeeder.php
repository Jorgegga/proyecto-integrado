<?php

namespace Database\Seeders;

use App\Models\Autor;
use Illuminate\Database\Seeder;

class AutorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Autor::create([
            'nombre'=>'Desconocido',
            'descripcion'=>'Musica sin autor',
            'genero_id'=>'1',
        ]);
        Autor::create([
            'nombre'=>'Zun',
            'descripcion'=>'Gran música',
            'genero_id'=>'6',
        ]);
    }
}
