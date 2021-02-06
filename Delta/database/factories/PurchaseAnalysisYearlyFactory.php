<?php

namespace Database\Factories;

use App\Models\purchaseAnalysisYearly;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class purchaseAnalysisYearlyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = purchaseAnalysisYearly::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    
    public $itr = 2015;
    public function definition()
    {
        return [
            
            'year' =>$this->itr++ ,
            'count' => rand(0, 10000),
            'product_count' => rand(0, 50000),
            'cost' => rand(0, 100000),
            'amount' => rand(0, 120000),
            'discount' => rand(0, 50000),
            'return' => rand(0, 10000),
            'due' => rand(0, 10000),
            'cash_given' => rand(0, 10000),
        ];
    }
}
