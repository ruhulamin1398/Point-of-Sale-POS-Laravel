<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
       
            $table->bigIncrements('id');
            $table->string('phone')->unique();
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->unsignedBigInteger('customer_type_id')->nullable();
            $table->bigInteger('due');
            $table->timestamps();

            $table->foreign('customer_type_id')->references('id')->on('customer_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
