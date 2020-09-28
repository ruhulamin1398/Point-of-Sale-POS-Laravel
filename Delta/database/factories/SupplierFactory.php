<?php

namespace Database\Factories;

use App\Models\supplier;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class supplierFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = supplier::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name ,
            'phone' => $this->faker->numberBetween($min = 11111111111, $max = 99999999999),
            'address' => $this->faker->address,
            'company' => $this->faker->company,
        ];
    }
}
