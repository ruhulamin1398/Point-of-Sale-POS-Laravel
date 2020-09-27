<?php

namespace Database\Factories;

use App\Models\employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class employeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'phone' => $this->faker->numberBetween($min = 11111111111, $max = 99999999999),
            'address' => $this->faker->address,
            'joining_date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'reference' => 'admin',
            'term_of_contract' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'designation' => $this->faker->jobTitle,
       
        ];
    }
}
