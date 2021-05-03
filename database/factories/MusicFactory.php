<?php

namespace Database\Factories;

use App\Models\{Music, Album};
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
        return [
            'nombre'=>ucwords($this->faker->sentence($nbWords = 4, $variableNBWords = true)),
            'descripcion'=>$this->faker->text($maxNbChars = 30),
            'album_id'=>$this->faker->numberBetween($min=0, $max= 57),
            'numCancion'=>$this->faker->numberBetween($min=1, $max= 28),
        ];
    }
}
