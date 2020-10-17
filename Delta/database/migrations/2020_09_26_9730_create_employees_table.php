<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('designation_id')->nullable();
            $table->string('name');
            $table->string('phone');
            $table->string('address');
            $table->date('joining_date')->nullable();
            $table->string('reference')->nullable();
            $table->date('term_of_contract')->nullable();
            $table->integer('fixed_duty_hour')->nullable();
            $table->double('salary', 18, 2)->default(20000.00);
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
        Schema::dropIfExists('employees');
    }
}
