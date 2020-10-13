<?php

namespace Database\Factories;

use App\Models\expense;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class expenseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = expense::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
        ];
    }
}
