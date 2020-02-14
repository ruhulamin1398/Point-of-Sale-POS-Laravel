<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('product_type_id');
            $table->double('cost',8,2)->nullable();
            $table->unsignedBigInteger('weight')->nullable();
            $table->double('price_per_unit',8,2)->nullable();;
            $table->double('cost_per_unit',8,2)->nullable();;
            $table->unsignedBigInteger('price')->nullable();;
            $table->date('expire_date')->nullable();
            
            $table->bigInteger('stock')->default(0)->nullable();
            $table->double('sell',8,2)->default(0)->nullable();
            $table->bigInteger('low_limit')->default(0)->nullable();
   
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('product_type_id')->references('id')->on('product_types');

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
