<?php

namespace Database\Factories;

use App\Models\expenseType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class expenseTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = expenseType::class;

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
