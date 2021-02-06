<?php

namespace Database\Factories;

use App\Models\calculationAnalysisYearly;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class calculationAnalysisYearlyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = calculationAnalysisYearly::class;

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
            'expense' => rand(0, 100000),
            'payment' => rand(0, 500000),
            'buy' => rand(0, 1000000),
            'sell' => rand(0, 1200000),
            'sell_profit' => rand(0, 500000),
            'drop_loss' => rand(0, 100000),
            'tax' => rand(0, 100000),
        ];
    }
}
