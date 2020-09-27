<?php

namespace Database\Factories;

use App\Models\employeePaymentType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class employeePaymentTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = employeePaymentType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            
            'name' => $this->faker->name,
            'description' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
        ];
    }
}
