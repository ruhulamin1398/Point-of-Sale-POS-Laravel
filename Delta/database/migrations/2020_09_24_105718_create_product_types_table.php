<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

class CreateProductTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
                // Piece/Weight 
        Schema::create('product_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description')->nullable(); 
            $table->json('sell_types')->default(new Expression('(JSON_ARRAY())'));  //sell type id list . like as kg, gm / dozon , piece
            $table->softDeletes();
            $table->timestamps();
        });

        // show all but only description updateable

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_types');
    }
}
