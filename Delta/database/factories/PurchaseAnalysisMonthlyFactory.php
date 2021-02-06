<?php

namespace Database\Factories;

use App\Models\purchaseAnalysisMonthly;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class purchaseAnalysisMonthlyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = purchaseAnalysisMonthly::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    
    public $itr= 0;
    public function definition()
    {
        return [
            
            'month' => ((new Carbon)->parse('2021-12-01')->subDays($this->itr+=32))->format('Y-m-01'),
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
