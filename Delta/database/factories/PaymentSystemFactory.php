<?php

namespace Database\Factories;

use App\Models\paymentSystem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class paymentSystemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = paymentSystem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'payment_system' => $this->faker->randomElement($array = array ('cash','rocket','bkash')),
        ];
    }
}
