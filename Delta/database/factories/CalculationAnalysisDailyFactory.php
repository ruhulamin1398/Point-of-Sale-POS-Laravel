<?php

namespace Database\Factories;

use App\Models\calculationAnalysisDaily;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class calculationAnalysisDailyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = calculationAnalysisDaily::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public $itr = 0;
    public function definition()
    {

        return [
            'date' => ((new Carbon)->parse('2021-02-31')->subDays($this->itr++))->format('Y-m-d'),
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
