<?php

namespace Database\Factories;

use App\Models\{Music, Album, Autor};
use Faker\Provider\ar_JO\Text;
use Illuminate\Database\Eloquent\Factories\Factory;

class MusicFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Music::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $id_alb = random_int(1, 27);
        $id_autor = Album::select('autor_id')->where('id', $id_alb)->get()->first()->autor_id;
        $gener = Autor::select('genero_id')->where('id',$id_autor)->get()->first()->genero_id;
        return [
            'nombre'=>ucwords($this->faker->unique()->sentence($nbWords = 4, $variableNBWords = true)),
            'descripcion'=>$this->faker->text($maxNbChars = 30),
            'album_id'=>$id_alb,
            'numCancion'=>$this->faker->numberBetween($min=1, $max= 28),
            'autor_id'=>$id_autor,
            'genero_id'=>$gener
        ];
    }
}
