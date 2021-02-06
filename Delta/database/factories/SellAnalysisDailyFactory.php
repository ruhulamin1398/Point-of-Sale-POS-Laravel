<?php

namespace Database\Factories;

use App\Models\sellAnalysisDaily;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class sellAnalysisDailyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = sellAnalysisDaily::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public $itr= 0;
    public function definition()
    {
        return [
            
            'date' => ((new Carbon)->parse('2021-02-31')->subDays($this->itr++))->format('Y-m-d'),
            'count' => rand(0, 10000),
            'product_count' => rand(0, 50000),
            'cost' => rand(0, 100000),
            'amount' => rand(0, 120000),
            'discount' => rand(0, 50000),
            'return' => rand(0, 10000),
            'due' => rand(0, 10000),
            'cash_received' => rand(0, 10000),
        ];
    }
}
