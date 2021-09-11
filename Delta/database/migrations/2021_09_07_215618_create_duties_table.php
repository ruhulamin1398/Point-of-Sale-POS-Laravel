<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDutiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('duties', function (Blueprint $table) {
            $table->id();
            $table->date('day')->unique();
            $table->unsignedBigInteger('status_id')->default(3);
            $table->json('data')->default(json_encode(['']));
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('duties');
    }
}
