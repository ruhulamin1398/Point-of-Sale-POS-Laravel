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
            $table->id();
          
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('payment_system_id');
            $table->double('paid_amount',8,2)->default(0);
            $table->double('tax',8,2)->default(0);
            $table->double('cost',8,2)->default(0);
            $table->double('pre_due',8,2)->default(0);
            $table->double('due',8,2)->default(0);
            $table->double('discount',8,2)->default(0);
            $table->double('profit',8,2)->default(0);
            $table->double('total',8,2)->default(0);
     
            $table->json('payment_details')->default(json_encode(['']));// payment Details here


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
        Schema::dropIfExists('orders');
    }
}
