<?php

namespace Database\Seeders;

use App\Models\Genero;
use Illuminate\Database\Seeder;

class GeneroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$array = ['otro', 'rock', 'pop', 'clasica', 'electronica', 'trap', 'instrumental'];
        Genero::create([

            'nombre'=>'Otro',
        ]);
        Genero::create([

            'nombre'=>'Rock',
        ]);
        Genero::create([

            'nombre'=>'Pop',
        ]);
        Genero::create([

            'nombre'=>'Clasica',
        ]);
        Genero::create([

            'nombre'=>'Electronica',
        ]);
        Genero::create([

            'nombre'=>'Trap',
        ]);
        Genero::create([

            'nombre'=>'Instrumental',
        ]);
    }
}
