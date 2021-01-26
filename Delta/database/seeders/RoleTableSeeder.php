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
                'name' => 'Super Admin',
                'email' => 'superadmin@abasas.tech',
                'password' => Hash::make(1234),
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@abasas.tech',
                'password' => Hash::make(1234),
            ],
            [
                'name' => 'Staff',
                'email' => 'staff@abasas.tech',
                'password' => Hash::make(1234),
            ]
        ]);
    
        DB::table('categories')->insert([
            [
                'name' => 'No Category',
                'description' => 'No Category',
            ],
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
                 'name' => 'No Brand',
                'description' => 'No brand Product',
            ],
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
                'name' => 'Piece',
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
            [
                'name' => 'Gram',
                'product_type_id'=>2,
                'value'=>0.001,
                'description' => 'unit description 2',
                
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
                'unit_id'=>3,
                'description'=>'plo make you comfortable',

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
                'unit_id'=>3,
                'description'=>'Dont Buy HP,its really bad',

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
                'unit_id'=>3,
                'description'=>'plo make you comfortable',

            ],

        ]);

        DB::table('employee_duties')->insert([
            [
                'employee_id' => 1,
                'duty_status_id' => 1,
                'enter_time' => '2020-10-13 22:27:06',
                'exit_time' => '2020-10-13 22:27:06',
                'fixed_duty_hour' => '8',
                'worked_hour' => '8:00:00',
                'date' => '2020-09-16',
                'comment' => 'comment 1',
            ],
            [
                'employee_id' => 2,
                'duty_status_id' => 2,
                'enter_time' => '2020-10-13 22:27:06',
                'exit_time' => '2020-10-13 22:27:06',
                'fixed_duty_hour' => '8',
                'worked_hour' => '8:00:00',
                'date' => '2020-09-16',
                'comment' => 'comment 2',
            ],
            [

                'employee_id' => 3,
                'duty_status_id' => 3,
                'enter_time' => '2020-10-13 22:27:06',
                'exit_time' => '2020-10-13 22:27:06',
                'fixed_duty_hour' => '8',
                'worked_hour' => '8:00:00',
                'date' => '2020-09-16',
                'comment' => 'comment 3',
            ],
        ]);
        DB::table('employee_duty_monthlies')->insert([
            [

                'employee_id' => 1,
                'month' => '2020-09-01',
                'present' => 20,
                'absent' => 5,
            ],
            [

                'employee_id' => 2,
                'month' => '2020-09-01',
                'present' => 21,
                'absent' => 5,
            ],
            [

                'employee_id' => 3,
                'month' => '2020-09-01',
                'present' => 10,
                'absent' => 5,
            ]
        ]);
        DB::table('suppliers')->insert([
            [
                'name' => 'Walk in Supplier',
                'phone' => '01234567890',
                'address' => 'Abasas.tech',
                'company' => 'Abasas.tech',
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
                'name' => 'Walk in Customer',
                'phone' => '01234567890',
                'address' => 'Abasas.tech',
                'company' => 'Abasas.tech',
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
                    'name' => 'Present',
                    'description' => 'Employee is present',
                ],
                [
                    'name' => 'Absent',
                    'description' => 'Employee is absent',
                ],
                [
                    'name' => 'Day off',
                    'description' => 'This is day off',
                ],
                [
                    'name' => 'Vacation',
                    'description' => 'Employee on Vacation',
                ],
        ]);
    
        DB::table('employees')->insert([
            [   
                'user_id' => 1,
                'name' => 'masum',
                'phone' => '01718988564',
                'address' => 'address 1',
                'joining_date' => '2020-09-16',
                'fixed_duty_hour'=>'8',
                'reference' => 'admin',
                'term_of_contract' => '2020-09-16',
                'designation_id' =>2,
            ],
            [
                'user_id' => 2,
                'name' => 'ruhul',
                'phone' => '01840000408',
                'address' => 'address 2',
                'joining_date' => '2020-09-16',
                'fixed_duty_hour'=>'8',
                'reference' => 'admin',
                'term_of_contract' => '2020-09-16',
                'designation_id' => 1,
            ],
            [
                'user_id' => 3,
                'name' => 'sourov',
                'phone' => '01729867026',
                'address' => 'address 3',
                'joining_date' => '2020-09-16',
                'fixed_duty_hour'=>'8',
                'reference' => 'admin',
                'term_of_contract' => '2020-09-16',
                'designation_id' => 1,
            ],
        ]);
    
        DB::table('employee_payments')->insert([
            [
                'employee_id' => 1,
                'employee_payment_type_id' => 1,
                'salary_status_id' => 1,
                'amount'=>1200.00,
                'month' => '2020-09-01',
                'Comment' => 'comment 1',
            ],
            [

                'employee_id' => 2,
                'employee_payment_type_id' => 1,
                'salary_status_id' => 2,
                'amount'=>1200.00,
                'month' => '2020-09-01',
                'Comment' => 'comment 2',
            ],
            [

                'employee_id' => 3,
                'employee_payment_type_id' => 1,
                'salary_status_id' => 1,
                'amount'=>1200.00,
                'month' => '2020-09-01',
                'Comment' => 'comment 3',
            ],
        ]);
    
        DB::table('employee_salaries')->insert([
            [
                'employee_id' => 1,
                'salary_status_id' => 1,
                'fixed_salary'=>1200.00,
                'amount_salary'=>1200.00,
                'amount_other'=>500.00,
                'month' => '2020-09-01',
            ],
            [

                'employee_id' => 2,
                'salary_status_id' => 1,
                'fixed_salary'=>1200.00,
                'amount_salary'=>1200.00,
                'amount_other'=>500.00,
                'month' => '2020-09-01',
            ],
            [
  
                'employee_id' => 3,
                'salary_status_id' => 1,
                'fixed_salary'=>1200.00,
                'amount_salary'=>1200.00,
                'amount_other'=>500.00,
                'month' => '2020-09-01',
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

        DB::table('designations')->insert([
            [
                'name' => 'manager',
                'description' => ' manager can do anything',
            ],
            [
                'name' => 'staf',
                'description' =>'will help to sell',
            ],
            [
                'name' => 'cleaner',
                'description' => 'nargis is cleaner',
            ],
        ]);

        DB::table('salary_statuses')->insert([
            [
                'name' => 'Completed',
                'description' => 'Completed',
            ],
            [
                'name' => 'Incomplete',
                'description' =>'Incomplete',
            ],
        ]);

        DB::table('expense_types')->insert([
            [
                'name' => 'Breakfast',
                'description' => 'This goes to breakfast',
            ],
            [
                'name' => 'Internet bill',
                'description' =>'This goes to internet bill',
            ],
        ]);

        DB::table('expenses')->insert([
            [
                'employee_id' => 1,
                'expense_type_id' => 1,
                'amount' => 400.5,
            ],
            [
                'employee_id' => 2,
                'expense_type_id' =>2,
                'amount' =>2,
            ],
        ]);

        DB::table('tax_types')->insert([
            
            [
                'name' => 'Excluded',
                'description' => 'Price Excludes Tax' ,
            ],
            [
                'name' => 'Included',
                'description' => 'Price Includes Tax',
            ],
        ]);

        DB::table('warrenties')->insert([
            [
                'name' => 'No Warrenty',
                'total_days' => 0,
            ],
            [
                'name' => '1 Year',
                'total_days' => 365,
            ],
        ]);


        
        DB::table('roles')->insert([
            [
                'name' => 'Super Admin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Admin',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Staff',
                'guard_name' => 'web',

            ],
    ]);

            
    DB::table('permissions')->insert([
        [
            'name' => 'create',
            'guard_name' => 'web',
        ],
        [
            'name' => 'read',
            'guard_name' => 'web',

        ],
        [
            'name' => 'edit',
            'guard_name' => 'web',

        ],
        [
            'name' => 'delete',
            'guard_name' => 'web',

        ],
    ]);
            
    DB::table('model_has_roles')->insert([
        [
            'role_id' => 1,
            'model_type' => 'App\Models\User',
            'model_id ' => 1,
        ],
        [
            'role_id' => 2,
            'model_type' => 'App\Models\User',
            'model_id ' => 2,
        ],
        [
            'role_id' => 3,
            'model_type' => 'App\Models\User',
            'model_id ' => 3,
        ],
    ]);
    DB::table('goals')->insert([
        [
            'daily' => 25,
            'weekly' => 175,
            'monthly' => 750,
            'yearly' => 9125
        ],


    ]);




    }
}
