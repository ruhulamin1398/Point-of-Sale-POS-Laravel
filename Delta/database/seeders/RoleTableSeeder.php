<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->insert([
            [
                'name' => 'ruhul',
                'email' => 'ruhul@gmail.com',
                'password' => Hash::make(1234),
            ],
            [
                'name' => 'sourov',
                'email' => 'sourov@gmail.com',
                'password' => Hash::make(1234),
            ],
            [
                'name' => 'masum',
                'email' => 'masum@gmail.com',
                'password' => Hash::make(1234),
            ],

        ]);
    
        DB::table('categories')->insert([
                [
                    'name' => 'Electronics',
                    'description' => 'description_1',
                ],
                [
                    'name' => 'Cloth',
                    'description' => 'description_2',
                ],
                [
                    'name' => 'Food',
                    'description' => 'description_3',
                ],
        ]);


        DB::table('brands')->insert([
            [ 
                 'name' => 'walton',
                'description' => 'walton products',
            ],
            [ 
                'name' => 'HP',
               'description' => 'HP is very bad',
            ],
            [ 
            'name' => 'mabrics',
           'description' => 'your style mabrics products',
       ],
        ]);


        DB::table('units')->insert([
            [
                'name' => 'K.G.',
                'product_type_id'=>2,
                'value'=>1,
                'description'=> 'unit description 1',
            ],
            [
                'name' => 'Gram',
                'product_type_id'=>2,
                'value'=>0.001,
                'description' => 'unit description 2',
                
            ],
            [
                'name' => 'pcs',
                'product_type_id'=>1,
                'value'=>1,
                'description' => 'unit description 3',
            ],
            [
                'name' => 'Dozon',
                'product_type_id'=>1,
                'value'=>12,
                'description' => 'unit description 4',
            ],
    ]);

        DB::table('products')->insert([
            [
                'name' => 'Polo Shirt',
                'category_id' => 1,
                'image_id'=> 1,
                'brand_id'=> 1,
                'price_per_unit'=>100,
                'cost_per_unit'=>50,
                'stock'=>'50',
                'stock_alert'=>20,
                'sell'=>10,
                'description'=>'plo make you comfortable',
                'warrenty'=>360,

            ],
            [
                'name' => 'HP Laptop',
                'category_id' => 2,
                'image_id'=> 2,
                'brand_id'=> 2,
                'price_per_unit'=>100,
                'cost_per_unit'=>50,
                'stock'=>'50',
                'stock_alert'=>20,
                'sell'=>10,
                'description'=>'Dont Buy HP,its really bad',
                'warrenty'=>360,

            ],  
             
            [
                'name' => 'Polo jeans',
                'category_id' => 3,
                'image_id'=> 3,
                'brand_id'=> 3,
                'price_per_unit'=>100,
                'cost_per_unit'=>50,
                'stock'=>'50',
                'stock_alert'=>20,
                'sell'=>10,
                'description'=>'plo make you comfortable',
                'warrenty'=>360,

            ],

        ]);

        DB::table('employee_duties')->insert([
            [
                'user_id' => 1,
                'employee_id' => 1,
                'duty_status_id' => 1,
                'enter_time' => '14:22:51',
                'exit_time' => '22:22:51',
                'fixed_duty_hour' => '8:00:00',
                'worked_hour' => '8:00:00',
                'date' => '2020-09-16',
                'comment' => 'comment 1',
            ],
            [
                'user_id' => 2,
                'employee_id' => 2,
                'duty_status_id' => 2,
                'enter_time' => '14:22:51',
                'exit_time' => '22:22:51',
                'fixed_duty_hour' => '8:00:00',
                'worked_hour' => '8:00:00',
                'date' => '2020-09-16',
                'comment' => 'comment 2',
            ],
            [
                'user_id' => 3,
                'employee_id' => 3,
                'duty_status_id' => 3,
                'enter_time' => '14:22:51',
                'exit_time' => '22:22:51',
                'fixed_duty_hour' => '8:00:00',
                'worked_hour' => '8:00:00',
                'date' => '2020-09-16',
                'comment' => 'comment 3',
            ],
        ]);
        DB::table('employee_duty_monthlies')->insert([
            [
                'user_id' => 1,
                'employee_id' => 1,
                'month' => '2020-09-16',
            ],
            [
                'user_id' => 2,
                'employee_id' => 2,
                'month' => '2020-09-16',
            ],
            [
                'user_id' => 3,
                'employee_id' => 3,
                'month' => '2020-09-16',
            ]
        ]);
        DB::table('suppliers')->insert([
            [
                'name' => 'supplier 1',
                'phone' => '01840000408',
                'address' => 'address 1',
                'company' => 'company 1',
            ],
            [
                'name' => 'supplier 2',
                'phone' => '01718988564',
                'address' => 'address 2',
                'company' => 'company 2',
            ],
            [
                'name' => 'supplier 3',
                'phone' => '01729867026',
                'address' => 'address 3',
                'company' => 'company 3',
            ],
        ]);
        DB::table('customers')->insert([
            [
                'name' => 'customer 1',
                'phone' => '01840000408',
                'address' => 'address 1',
                'company' => 'company 1',
            ],
            [
                'name' => 'customer 2',
                'phone' => '01718988564',
                'address' => 'address 2',
                'company' => 'company 2',
            ],
            [
                'name' => 'customer 3',
                'phone' => '01729867026',
                'address' => 'address 3',
                'company' => 'company 3',
            ],
        ]);
        DB::table('customer_ratings')->insert([
            [
                'star_count' => 5,
                'name' => 'name 1',
                'description' => 'description 1',
            ],
            [
                'star_count' => 5,
                'name' => 'name 2',
                'description' => 'description 2',
            ],
            [
                'star_count' => 5,
                'name' => 'name 3',
                'description' => 'description 3',
            ],
        ]);
        DB::table('payment_systems')->insert([
            [
                'payment_system' => 'cash',
                'description'=>'bkash is most popular way',
            ],
            [
                'payment_system' => 'rocket',
                'description'=>'rocket is most popular way',
            ],
            [
                'payment_system' => 'card',
                'description'=>'you can also use card',
            ],
        ]);
    
        DB::table('duty_statuses')->insert([
                [
                    'name' => 'present',
                    'description' => 'he is present',
                ],
                [
                    'name' => 'absent',
                    'description' => 'he is absent',
                ],
                [
                    'name' => 'day off',
                    'description' => 'this is day off',
                ],
        ]);
    
        DB::table('employees')->insert([
            [
                'name' => 'employee 1',
                'phone' => '01718988564',
                'address' => 'address 1',
                'joining_date' => '2020-09-16',
                'reference' => 'admin',
                'term_of_contract' => '2020-09-16',
                'designation' => 'manager',
            ],
            [
                'name' => 'employee 2',
                'phone' => '01840000408',
                'address' => 'address 2',
                'joining_date' => '2020-09-16',
                'reference' => 'admin',
                'term_of_contract' => '2020-09-16',
                'designation' => 'staff',
            ],
            [
                'name' => 'employee 3',
                'phone' => '01729867026',
                'address' => 'address 3',
                'joining_date' => '2020-09-16',
                'reference' => 'admin',
                'term_of_contract' => '2020-09-16',
                'designation' => 'manager',
            ],
        ]);
    
        DB::table('employee_payments')->insert([
            [
                'user_id' => 1,
                'employee_id' => 1,
                'employee_payment_type_id' => 1,
                'status' => 'completed',
                'date' => '2020-09-16',
                'Comment' => 'comment 1',
            ],
            [
                'user_id' => 2,
                'employee_id' => 2,
                'employee_payment_type_id' => 2,
                'status' => 'completed',
                'date' => '2020-09-16',
                'Comment' => 'comment 2',
            ],
            [
                'user_id' => 3,
                'employee_id' => 3,
                'employee_payment_type_id' => 1,
                'status' => 'completed',
                'date' => '2020-09-16',
                'Comment' => 'comment 3',
            ],
        ]);
    
        DB::table('employee_salaries')->insert([
            [
                'user_id' => 1,
                'employee_id' => 1,
                'status' => 'completed',
                'month' => '2020-09-16',
            ],
            [
                'user_id' => 2,
                'employee_id' => 2,
                'status' => 'completed',
                'month' => '2020-09-16',
            ],
            [
                'user_id' => 3,
                'employee_id' => 3,
                'status' => 'completed',
                'month' => '2020-09-16',
            ],
        ]);
    
        DB::table('employee_payment_types')->insert([
            [
                'name' => 'Salary',
                'description' => 'description 1',
            ],
            [
                'name' => 'Bonus',
                'description' => 'description 2',
            ],
            [
                'name' => 'Extraa',
                'description' => 'description 3',
            ],
        ]);

        DB::table('product_types')->insert([
            [
                'name' => 'Piece',
                'description' => 'By piece bt piece',
            ],
            [
                'name' => 'Weight',
                'description' => 'By Wight in measures',
            ],
        ]);





    }
}
