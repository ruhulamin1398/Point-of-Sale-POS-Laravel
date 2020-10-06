<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

class CreateEmployeeDutiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_duties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('duty_status_id');
            $table->time('enter_time')->nullable();
            $table->time('exit_time')->nullable();
            $table->time('fixed_duty_hour');
            $table->time('worked_hour')->nullable();
            $table->date('date');
            $table->longText('comment')->nullable();
            $table->json('data')->default(new Expression('(JSON_ARRAY())'));
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
        Schema::dropIfExists('employee_duties');
    }
}
