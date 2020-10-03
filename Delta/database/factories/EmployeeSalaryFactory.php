<?php

namespace Database\Factories;

use App\Models\employeeSalary;
use App\Models\User;
use App\Models\employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class employeeSalaryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = employeeSalary::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' =>User::all()->random()->id,
            'employee_id' =>employee::all()->random()->id,
            'status' => 'completed',
            'month' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
        ];
    }
}
