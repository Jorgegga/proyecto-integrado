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
            'id'=>'2',
            'genero_id'=>'5',
        ]);
        Autor::create([
            'nombre'=>'Zun',
            'descripcion'=>'Gran música',
            'id'=>'3',
            'genero_id'=>'4',
        ]);
    }
}
