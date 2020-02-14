
<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('roles')->insert([
            [
                'role' => 'Admin'
            ],
            [
                'role' => 'Staff'
            ],

        ]);

        DB::table('users')->insert(
            [
                [

                    'id'    => 100,
                    'username' => 'ruhul',
                    'role_id' => 1,
                    'email' => 'ruhul.ok@gmail.com',
                    'name' => 'Ruhul Amin',
                    'address' => 'Habigong',
                    'phone' => '01840000408',
                    'salary' => '50000',
                    'password' => Hash::make(1234),
                    'status'    => 1
                ],

                [
                    'id'    => 101,
                    'username' => 'sagor',
                    'role_id' => 2,
                    'email' => 'sagor.sec@gmail.com',
                    'name' => 'Sajjad Hossain Sagor ',
                    'address' => 'Tangail',
                    'phone' => '01799076632',
                    'salary' => '20000',
                    'password' => Hash::make(1234),
                    'status'    => 1
                ],

            ]
        );

        DB::table('suppliers')->insert([
            [
                'id'    => 100,
                'name' => 'ruhul',
                'phone' => '01840000408',
                'address' => 'Habigong',
                'company' => 'Pran',
                'due' => '5000'
            ],
            [
                'id'    => 101,
                'name' => 'sagor',
                'phone' => '01799076632',
                'address' => 'Tangail',
                'company' => 'Arong',
                'due' => '7000'
            ],
        ]);



        DB::table('categories')->insert([
            [
                'id'    => 100,
                'name' => 'no_category',
                'description' => 'Not add in any category'
            ],
            [
                'id'    => 101,
                'name' => 'striker',
                'description' => 'just a sign'
            ],
            [
                'id'    => 102,
                'name' => 'complete',
                'description' => 'now ready for sele'
            ],

        ]);

        DB::table('payment_types')->insert([
            [
                'type' => 'invoice'
            ],
            [
                'type' => 'due'
            ],

        ]);

        DB::table('cost_types')->insert([
            [
                'id'    => 100,
                'type' => 'Daily Cost'
            ],
            [
                'id'    => 101,
                'type' => 'Sallery'
            ],

        ]);

        DB::table('product_types')->insert([
            [
                'name' => 'normal',
                'description' => 'normal sale with weight ',
              
            ],
            [
                'name' => 'packet',
                'description' => 'sale as a packet',
                
            ],

        ]);

        DB::table('products')->insert([
            [
                'id' => 100,
                'name' => 'লাল শাক ',
                'category_id' => 100,
                'product_type_id' => 2,
                'cost' => 10,
                'price' => 12,
                'weight' => 1000,
                'stock' => 100,
                'sell' => 50,
                'low_limit' => 10,
                'price_per_unit' => 1.3,
                'cost_per_unit' => 1.3

            ],

            [
                'id' => 101,
                'name' => 'পালং শাক',
                'category_id' => 101,
                'product_type_id' => 1,
                'cost' => 20,
                'price' => 24,
                'stock' => 100,
                'weight' => 500,
                'sell' => 50,
                'low_limit' => 10,
                'price_per_unit' => 1.3,
                'cost_per_unit' => 1.3
            ],
            [
                'id' => 102,
                'name' => 'মূলা',
                'category_id' => 102,
                'product_type_id' => 2,
                'cost' => 20,
                'price' => 24,
                'weight' => 10,
                'stock' => 100,
                'sell' => 50,
                'low_limit' => 10,
                'price_per_unit' => 1.3,
                'cost_per_unit' => 1.3
            ],
            [
                'id' => 103,
                'name' => 'গাজর',
                'category_id' => 102,
                'product_type_id' => 2,
                'cost' => 20,
                'price' => 24,
                'weight' => 20,
                'stock' => 100,
                'sell' => 50,
                'low_limit' => 10,
                'price_per_unit' => 1.3,
                'cost_per_unit' => 1.3
            ],

        ]);

        DB::table('customer_types')->insert([
            ['name' => 'regular'],
            ['name' => 'normal']


        ]);

        DB::table('customers')->insert([
            [
                'phone' => '01840000408',
                'name' => 'ruhul',
                'address' => 'Habigong',
                'customer_type_id' => 1,
                'due' => 10000
            ],

            [
                'phone' => '01846000402',
                'name' => 'masum',
                'address' => 'Tangail',
                'customer_type_id' => 2,
                'due' => 20000
            ],

        ]);
    }
}
