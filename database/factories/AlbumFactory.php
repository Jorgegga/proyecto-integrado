<?php

namespace Database\Factories;

use App\Models\{Album, Autor};
use Illuminate\Database\Eloquent\Factories\Factory;

class AlbumFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Album::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $id_autor=random_int(1,22);
        $gener = Autor::select('genero_id')->where('id',$id_autor)->get()->first()->genero_id;
        return [
            'nombre'=>ucwords($this->faker->unique()->sentence($nbWords = 3, $variableNBWords = true)),
            'descripcion'=>ucfirst($this->faker->text(35)),
            'autor_id'=>$id_autor,
            'genero_id'=>$gener,
        ];
    }
}
