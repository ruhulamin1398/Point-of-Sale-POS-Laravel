<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeAnalysisYearliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_analysis_yearlies', function (Blueprint $table) {
            $table->id();
            $table->year('year');
            $table->unsignedBigInteger('employee_id')->default(1);
            $table->double('sell',18,2)->default(0);
            $table->double('profit',18,2)->default(0);
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
        Schema::dropIfExists('employee_analysis_yearlies');
    }
}
