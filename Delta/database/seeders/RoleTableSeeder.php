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
                    'name' => 'category_1',
                    'description' => 'description_1',
                ],
                [
                    'name' => 'category_2',
                    'description' => 'description_2',
                ],
                [
                    'name' => 'category_3',
                    'description' => 'description_3',
                ],
        ]);
        DB::table('units')->insert([
            [
                'name' => 'Unit 1',
                'description' => 'unit description 1',
            ],
            [
                'name' => 'unit 2',
                'description' => 'unit description 2',
            ],
            [
                'name' => 'unit 3',
                'description' => 'unit description 3',
            ],
    ]);

        DB::table('products')->insert([
            [
                'name' => 'product 1',
                'category_id' => 2,
                'image_id'=>'1',
                'product_type_id' => 1,
                'cost' => 2,
                'weight' => 2,
                'price_per_unit' => 2,
                'cost_per_unit' => 2,
                'price' => 2,
                'description' => 'description 1',
                'stock' => 2,
                'stock_alert' => 2,
                'sell' => 2,
                'stock' => 2,
            ],
            [
                'name' => 'product 2',
                'category_id' => 2,
                'product_type_id' => 2,
                'cost' => 2,
                'weight' => 2,
                'price_per_unit' => 2,
                'cost_per_unit' =>2,
                'price' => 2,
                'description' => 'description 2',
                'stock' => 2,
                'stock_alert' => 2,
                'sell' => 2,
                'stock' => 2,
            ],
            [
                'name' => 'product 3',
                'category_id' => 3,
                'product_type_id' => 3,
                'cost' => 3,
                'weight' => 3,
                'price_per_unit' => 3,
                'cost_per_unit' => 3,
                'price' => 3,
                'description' => 'description 3',
                'stock' => 3,
                'stock_alert' => 3,
                'sell' => 3,
                'stock' => 3,
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
            ],
            [
                'payment_system' => 'rocket',
            ],
            [
                'payment_system' => 'bkash',
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
        DB::table('images')->insert([
            [
                'url' => 'this is image description ',
            ],
        ]);
        DB::table('brands')->insert([
            [ 
                 'name' => 'Brand 1',
                'description' => 'Brand Descripton 1',
            ],
            [ 
                'name' => 'Brand 2',
               'description' => 'Brand Descripton 2',
            ],
            [ 
            'name' => 'Brand 3',
           'description' => 'Brand Descripton 3',
       ],
        ]);



    }
}
