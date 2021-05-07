<?php

namespace Database\Factories;

use App\Models\Album;
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
        return [
            'nombre'=>ucwords($this->faker->unique()->sentence($nbWords = 3, $variableNBWords = true)),
            'descripcion'=>ucfirst($this->faker->text(35)),
            'autor_id'=>$this->faker->numberBetween($min=0, $max= 50),
        ];
    }
}
