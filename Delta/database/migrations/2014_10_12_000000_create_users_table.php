<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->nullable();
            $table->unsignedBigInteger('role_id')->default(2);
            $table->string('email')->unique();
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->unsignedBigInteger('salary')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            
            $table->unsignedBigInteger('status')->default(0);
            $table->rememberToken();
            $table->timestamps();


             $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
