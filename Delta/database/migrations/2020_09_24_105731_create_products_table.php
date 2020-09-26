<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('product_type_id')->default(2);
            $table->double('cost',8,2)->nullable();
            $table->double('weight',8,3)->nullable();
            $table->double('price_per_unit',8,2)->nullable();
            $table->double('cost_per_unit',8,2)->nullable();
            $table->unsignedBigInteger('price')->nullable();;
            $table->string('description')->nullable();
            $table->bigInteger('stock')->default(0)->nullable();
            $table->bigInteger('stock_alert')->default(0)->nullable();
            $table->double('sell',8,2)->default(0)->nullable();
            $table->json('serial')->default(new Expression('(JSON_ARRAY())'));
            $table->json('data')->default(new Expression('(JSON_ARRAY())'));
            $table->json('discount')->default(new Expression('(JSON_ARRAY())'));
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
        Schema::dropIfExists('products');
    }
}
