<?php

namespace Database\Factories;

use App\Models\Hero;
use Illuminate\Database\Eloquent\Factories\Factory;

class HeroFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Hero::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'          => $this->faker->firstName($gender = 'male'|'female').' '.$this->faker->lastName(),
            'real_name'     => $this->faker->jobTitle(),
            'description'   => $this->faker->text(),
            'avatar'        => $this->faker->imageUrl(640, 480, 'animals', true),
            'can_fly'       => random_int(0, 1)
        ];
    }
}
