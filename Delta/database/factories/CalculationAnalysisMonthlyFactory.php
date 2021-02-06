<?php

namespace Database\Factories;

use App\Models\calculationAnalysisMonthly;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class calculationAnalysisMonthlyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = calculationAnalysisMonthly::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public $itr= 0;
    public function definition()
    {
        return [
            
            'month' => ((new Carbon())->parse('2021-12-01')->subDays($this->itr+=32))->format('Y-m-01'),
            'expense' => rand(0, 10000),
            'payment' => rand(0, 50000),
            'buy' => rand(0, 100000),
            'sell' => rand(0, 120000),
            'sell_profit' => rand(0, 50000),
            'drop_loss' => rand(0, 10000),
            'tax' => rand(0, 10000),
        ];
    }
}
