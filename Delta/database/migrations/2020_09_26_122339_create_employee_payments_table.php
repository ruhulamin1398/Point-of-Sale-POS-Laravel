<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

class CreateEmployeePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('employee_payment_type_id');
            $table->unsignedBigInteger('salary_status_id')->default(2);
            $table->double('amount', 18, 2);
            $table->double('changed_amount', 18, 2)->default(0.00);
            $table->date('month');
            $table->longText('comment')->nullable();
            $changedData= [
                'status'=>false,
                'data'=>[]
            ];
            $table->json('changed_data')->default(json_encode($changedData));
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
        Schema::dropIfExists('employee_payments');
    }
}
