<?php

namespace Database\Factories;

use App\Models\employeeDuty;
use App\Models\User;
use App\Models\employee;
use App\Models\dutyStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class employeeDutyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = employeeDuty::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'employee_id' => employee::all()->random()->id,
            'duty_status_id' => dutyStatus::all()->random()->id,
            'enter_time' => $this->faker->dateTimeBetween('this week', '+12 days'),
            'exit_time' => $this->faker->dateTimeBetween('this week', '+12 days'),
            'fixed_duty_hour' => $this->faker->time($format = 'H:i:s', $max = 'now'),
            'worked_hour' => $this->faker->time($format = 'H:i:s', $max = 'now'),
            'date' => '2020-10-17',
            'comment' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
        ];
    }
}
