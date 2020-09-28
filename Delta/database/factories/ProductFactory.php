<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $totalCost = $this->faker->randomFloat($nbMaxDecimals = 2, $min = 100, $max = 200);
        $totalWeight = $this->faker->randomFloat($nbMaxDecimals = 3, $min = 1, $max = 10);
        $costPerUnit = $totalCost/$totalWeight;
        $pricePerUnit = $costPerUnit+20;
        $price = $totalCost+100;
        return [
            'name'=> $this->faker->name,
            'category_id'=>category::all()->random()->id,
            'product_type_id'=> $this->faker->randomDigit,
            'cost'=> $totalCost,
            'weight'=> $totalWeight,
            'price_per_unit'=> $pricePerUnit,
            'cost_per_unit'=> $costPerUnit,
            'price'=> $price,
            'description'=> $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'sell'=> $price,
        ];
    }
}
