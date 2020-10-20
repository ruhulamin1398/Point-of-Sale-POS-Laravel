<?php

namespace Database\Factories;

use App\Models\brand;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class brandFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = brand::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description'=> $this->faker->sentence(15),
        ];
    }
}
