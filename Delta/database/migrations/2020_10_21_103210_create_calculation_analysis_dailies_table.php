<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalculationAnalysisDailiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calculation_analysis_dailies', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->double('expense',18,2)->default(0);
            $table->double('payment',18,2)->default(0);
            $table->double('buy',18,2)->default(0);
            $table->double('sell',18,2)->default(0);
            $table->double('sell_profit',18,2)->default(0);
            $table->double('tax',18,2)->default(0);
            $table->json('data')->default(json_encode(['']));
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calculation_analysis_dailies');
    }
}
