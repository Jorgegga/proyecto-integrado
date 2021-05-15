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
            'id'=>0,
            'nombre'=>'otro',
        ]);
        Genero::create([
            'id'=>1,
            'nombre'=>'rock',
        ]);
        Genero::create([
            'id'=>2,
            'nombre'=>'pop',
        ]);
        Genero::create([
            'id'=>3,
            'nombre'=>'clasica',
        ]);
        Genero::create([
            'id'=>4,
            'nombre'=>'electronica',
        ]);
        Genero::create([
            'id'=>5,
            'nombre'=>'trap',
        ]);
        Genero::create([
            'id'=>6,
            'nombre'=>'instrumental',
        ]);
    }
}
