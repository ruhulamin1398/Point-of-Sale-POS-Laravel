<?php

namespace Database\Factories;

use App\Models\brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\productType;
use App\Models\unit;
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
             'type_id'=> productType::all()->random()->id,
             'brand_id'=> brand::all()->random()->id,
             'unit_id'=> unit::all()->random()->id,
            'price_per_unit'=> $pricePerUnit,
            'cost_per_unit'=> $costPerUnit,
            'tax'=> 10,
            'warrenty'=> 360,
            'description'=> $this->faker->sentence($nbWords = 6, $variableNbWords = true),
        ];
    }
}
