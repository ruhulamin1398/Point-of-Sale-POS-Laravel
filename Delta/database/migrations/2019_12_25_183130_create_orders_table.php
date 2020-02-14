<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {

            
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('pay')->nullable()->defult(0);
            $table->bigInteger('due')->default(0);;
            $table->bigInteger('pre_due')->default(0);
            $table->unsignedBigInteger('discount')->nullable();;
            $table->unsignedBigInteger('total');

            $table->unsignedBigInteger('total_discount')->nullable();;
            $table->unsignedBigInteger('total_profit')->nullable();;
            

            $table->unsignedBigInteger('payment')->nullable();;
            $table->timestamps();

            
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('customer_id')->references('id')->on('customers');




          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
