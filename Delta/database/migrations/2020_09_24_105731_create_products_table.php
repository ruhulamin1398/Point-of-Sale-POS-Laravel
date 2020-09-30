<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // weight->kg  
        //piece->piece  
        // warrenty->day
        // always store data in this table with only those units

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('image_id');
            $table->unsignedBigInteger('brand_id');
            

            $table->double('price_per_unit',8,2)->nullable();
            $table->double('cost_per_unit',8,2)->nullable();
            
            $table->double('stock',8,6)->nullable();
            $table->bigInteger('stock_alert')->default(1);

            $table->double('sell',8,2)->nullable();
            $table->double('tax',8,2)->nullable();

            
            $table->string('description')->nullable();
            
            $table->bigInteger('warrenty')->nullable(); //save in day 
            $serial= [
                'status'=>false,
                'data'=>[
                    'a3bc'=> '2020:10:10',   //serial: 'date'
                ]
            ];
            $discount= [
                'status'=>false,
                'type'=>'% / amount',
                'value'=>'0',
            ];
            $table->json('serial')->default(json_encode($serial)); 
            $table->json('discount')->default(json_encode($discount));
            $table->json('data')->default(json_encode(['']));
            $table->softDeletes();
            $table->timestamps();
            
        });


        // category image brand dropdown view and update
        // price_per_unit , cost_per_unit , stock_alert , description , show and editable 
        // stock only showable 
        // warrenty only updateable

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
