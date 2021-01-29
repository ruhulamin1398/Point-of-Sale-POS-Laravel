<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PosSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pos_settings')->insert([
            [ 
                 'shop_name' => 'Abasas POS',
                'shop_moto' => 'Not Number One, WE are Only One',
                'shop_phone' => '12345678999',
                'shop_email' => 'Abasas.tech@gmail.com',
                'language' => 'bn',
                'customer_due' => 'yes',
                'supplier_due' => 'yes',
                'logo' => 'image/abasas-logo.png',
            ],
         
        ]);

    }
}
