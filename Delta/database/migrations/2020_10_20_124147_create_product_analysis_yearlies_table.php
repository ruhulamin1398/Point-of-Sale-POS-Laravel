<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAnalysisYearliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_analysis_yearlies', function (Blueprint $table) {
            $table->id();
            $table->year('year');
            $table->unsignedBigInteger('product_id');
            $table->double('purchase',18,2)->default(0);
            $table->double('sell',18,2)->default(0);
            $table->double('return',18,2)->default(0);
            $table->double('drop',18,2)->default(0);
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
        Schema::dropIfExists('product_analysis_yearlies');
    }
}
