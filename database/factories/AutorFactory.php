<?php

namespace Database\Factories;

use App\Models\{Autor, Genero};
use Illuminate\Database\Eloquent\Factories\Factory;

class AutorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Autor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre'=>ucwords($this->faker->unique()->sentence($nbWords = 1, $variableNBWords = true)),
            'descripcion'=>ucfirst($this->faker->text(100)),
            'genero_id'=>$this->faker->numberBetween(1, 7),
        ];
    }
}
