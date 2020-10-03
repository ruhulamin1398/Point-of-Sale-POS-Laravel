<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('payment_system_id');

            $table->double('paid_amount',8,2)->default(0);
            $table->double('pre_due',8,2)->default(0);  
            $table->double('tax',8,2)->default(0);
            $table->double('due',8,2)->default(0);
            $table->double('discount',8,2)->default(0);
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
        Schema::dropIfExists('purchases');
    }
}
