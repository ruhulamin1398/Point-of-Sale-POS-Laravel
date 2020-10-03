<?php

namespace Database\Factories;

use App\Models\employeeDutyMonthly;
use App\Models\User;
use App\Models\employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class employeeDutyMonthlyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = employeeDutyMonthly::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id ,
            'employee_id' => employee::all()->random()->id,
            'month' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
        ];
    }
}
