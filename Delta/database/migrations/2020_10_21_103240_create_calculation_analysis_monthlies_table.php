<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalculationAnalysisMonthliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calculation_analysis_monthlies', function (Blueprint $table) {
            $table->id();
            $table->date('month');
            $table->double('expense',18,2)->default(0);
            $table->double('payment',18,2)->default(0);
            $table->double('buy',18,2)->default(0);
            $table->double('sell',18,2)->default(0);
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
        Schema::dropIfExists('calculation_analysis_monthlies');
    }
}
