<?php

namespace Database\Factories;

use App\Models\employeeDuty;
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
            'user_id' => $this->faker->randomDigit ,
            'employee_id' => $this->faker->randomDigit,
            'duty_status_id' => $this->faker->randomDigit,
            'enter_time' => $this->faker->time($format = 'H:i:s', $max = 'now'),
            'exit_time' => $this->faker->time($format = 'H:i:s', $max = 'now'),
            'fixed_duty_hour' => $this->faker->time($format = 'H:i:s', $max = 'now'),
            'worked_hour' => $this->faker->time($format = 'H:i:s', $max = 'now'),
            'date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'comment' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
        ];
    }
}
