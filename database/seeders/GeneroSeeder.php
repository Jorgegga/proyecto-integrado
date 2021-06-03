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
            'id'=>2,
            'nombre'=>'Otro',
        ]);
        Genero::create([
            'id'=>3,
            'nombre'=>'Rock',
        ]);
        Genero::create([
            'id'=>4,
            'nombre'=>'Pop',
        ]);
        Genero::create([
            'id'=>5,
            'nombre'=>'Clasica',
        ]);
        Genero::create([
            'id'=>6,
            'nombre'=>'Electronica',
        ]);
        Genero::create([
            'id'=>7,
            'nombre'=>'Trap',
        ]);
        Genero::create([
            'id'=>8,
            'nombre'=>'Instrumental',
        ]);
    }
}
