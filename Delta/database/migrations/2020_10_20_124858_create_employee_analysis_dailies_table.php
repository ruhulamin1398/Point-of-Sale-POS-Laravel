<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeAnalysisDailiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_analysis_dailies', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->double('sell',18,2)->default(0);
            $table->double('profit',18,2)->default(0);
            $table->softDeletes();
            $table->json('data')->default(json_encode(['']));
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
        Schema::dropIfExists('employee_analysis_dailies');
    }
}
