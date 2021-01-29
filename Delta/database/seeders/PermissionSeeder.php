<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('permissions')->insert([
            
            [
                'name' => 'Brand Create',
                'page_name' => 'Brand',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Brand Read',
                'page_name' => 'Brand',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Brand Edit',
                'page_name' => 'Brand',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Brand Delete',
                'page_name' => 'Brand',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Brand View',
                'page_name' => 'Brand',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Brand Page',
                'page_name' => 'Brand',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Unit Create',
                'page_name' => 'Unit',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Unit Read',
                'page_name' => 'Unit',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Unit Edit',
                'page_name' => 'Unit',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Unit Delete',
                'page_name' => 'Unit',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Unit Page',
                'page_name' => 'Unit',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Super Admin',
                'page_name' => 'All',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Customer Create',
                'page_name' => 'Customer',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Customer Read',
                'page_name' => 'Customer',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Customer Edit',
                'page_name' => 'Customer',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Customer Delete',
                'page_name' => 'Customer',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Customer View',
                'page_name' => 'Customer',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Customer Page',
                'page_name' => 'Customer',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Designation Create',
                'page_name' => 'Designation',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Designation Read',
                'page_name' => 'Designation',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Designation Edit',
                'page_name' => 'Designation',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Designation Delete',
                'page_name' => 'Designation',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Designation Page',
                'page_name' => 'Designation',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Drop Product Create Read',
                'page_name' => 'Drop Product Create',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Drop Product Create Edit',
                'page_name' => 'Drop Product Create',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Drop Product Create Delete',
                'page_name' => 'Drop Product Create',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Drop Product Create Page',
                'page_name' => 'Drop Product Create',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Drop Product Read',
                'page_name' => 'Drop Product',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Drop Product Edit',
                'page_name' => 'Drop Product',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Drop Product Delete',
                'page_name' => 'Drop Product',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Drop Product Page',
                'page_name' => 'Drop Product',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Duty Status Read',
                'page_name' => 'Duty Status',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Duty Status Page',
                'page_name' => 'Duty Status',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Employee Create',
                'page_name' => 'Employee',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Employee Read',
                'page_name' => 'Employee',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Employee Edit',
                'page_name' => 'Employee',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Employee Delete',
                'page_name' => 'Employee',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Employee View',
                'page_name' => 'Employee',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Employee Page',
                'page_name' => 'Employee',
                'guard_name' => 'web',
            ],
            
            [
                'name' => 'Employee Payments Create',
                'page_name' => 'Employee Payments',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Employee Payments Read',
                'page_name' => 'Employee Payments',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Employee Payments Edit',
                'page_name' => 'Employee Payments',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Employee Payments Delete',
                'page_name' => 'Employee Payments',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Employee Payments Page',
                'page_name' => 'Employee Payments',
                'guard_name' => 'web',
            ],
            
            [
                'name' => 'Employee Payment Type Read',
                'page_name' => 'Employee Payment Type',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Employee Payment Type Page',
                'page_name' => 'Employee Payment Type',
                'guard_name' => 'web',
            ],
            
            [
                'name' => 'Employee Salary Read',
                'page_name' => 'Employee Salary',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Employee Salary Page',
                'page_name' => 'Employee Salary',
                'guard_name' => 'web',
            ],
            
            [
                'name' => 'Payment System Read',
                'page_name' => 'Payment System',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Payment System Page',
                'page_name' => 'Payment System',
                'guard_name' => 'web',
            ],
            
            [
                'name' => 'Return From Customer Read',
                'page_name' => 'Return From Customer',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Return From Customer Page',
                'page_name' => 'Return From Customer',
                'guard_name' => 'web',
            ],
            
            [
                'name' => 'Return To Supplier Read',
                'page_name' => 'Return To Supplier',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Return To Supplier Page',
                'page_name' => 'Return To Supplier',
                'guard_name' => 'web',
            ],
            
            [
                'name' => 'Supplier Create',
                'page_name' => 'Supplier',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Supplier Read',
                'page_name' => 'Supplier',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Supplier Edit',
                'page_name' => 'Supplier',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Supplier Delete',
                'page_name' => 'Supplier',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Supplier View',
                'page_name' => 'Supplier',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Supplier Page',
                'page_name' => 'Supplier',
                'guard_name' => 'web',
            ],
            
            [
                'name' => 'Expense Type Create',
                'page_name' => 'Expense Type',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Expense Type Read',
                'page_name' => 'Expense Type',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Expense Type Edit',
                'page_name' => 'Expense Type',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Expense Type Delete',
                'page_name' => 'Expense Type',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Expense Type Page',
                'page_name' => 'Expense Type',
                'guard_name' => 'web',
            ],
            
            [
                'name' => 'Expense Create',
                'page_name' => 'Expense',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Expense Read',
                'page_name' => 'Expense',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Expense Edit',
                'page_name' => 'Expense',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Expense Delete',
                'page_name' => 'Expense',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Expense Page',
                'page_name' => 'Expense',
                'guard_name' => 'web',
            ],
            
            
            [
                'name' => 'Expense Monthly Read',
                'page_name' => 'Expense Monthly',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Expense Monthly Page',
                'page_name' => 'Expense Monthly',
                'guard_name' => 'web',
            ],
            
            [
                'name' => 'Stock Alert Read',
                'page_name' => 'Stock Alert',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Stock Alert Delete',
                'page_name' => 'Stock Alert',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Stock Alert Page',
                'page_name' => 'Stock Alert',
                'guard_name' => 'web',
            ],
            
            [
                'name' => 'Warrenty Create',
                'page_name' => 'Warrenty',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Warrenty Read',
                'page_name' => 'Warrenty',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Warrenty Edit',
                'page_name' => 'Warrenty',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Warrenty Delete',
                'page_name' => 'Warrenty',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Warrenty Page',
                'page_name' => 'Warrenty',
                'guard_name' => 'web',
            ],
            
            [
                'name' => 'Category Create',
                'page_name' => 'Category',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Category Read',
                'page_name' => 'Category',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Category Edit',
                'page_name' => 'Category',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Category Delete',
                'page_name' => 'Category',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Category View',
                'page_name' => 'Category',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Category Page',
                'page_name' => 'Category',
                'guard_name' => 'web',
            ],
            
            [
                'name' => 'Customer Due Receive Read',
                'page_name' => 'Customer Due Receive',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Customer Due Receive Page',
                'page_name' => 'Customer Due Receive',
                'guard_name' => 'web',
            ],
            
            [
                'name' => 'Supplier Due Pay Read',
                'page_name' => 'Supplier Due Pay',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Supplier Due Pay Page',
                'page_name' => 'Supplier Due Pay',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Customer Due Receive Create Page',
                'page_name' => 'Customer Due Receive Create',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Supplier Due Pay Create Page',
                'page_name' => 'Supplier Due Pay Create',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Return To Supplier Create Page',
                'page_name' => 'Return To Supplier Create',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Return From Customer Create Page',
                'page_name' => 'Return From Customer Create',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Product Page',
                'page_name' => 'Product',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Product View',
                'page_name' => 'Product',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Product Edit',
                'page_name' => 'Product',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Product Delete',
                'page_name' => 'Product',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Product Read',
                'page_name' => 'Product',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Product Create',
                'page_name' => 'Product',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Product Price',
                'page_name' => 'Product',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Product Cost',
                'page_name' => 'Product',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Product Graph',
                'page_name' => 'Product',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Product Print',
                'page_name' => 'Product',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Order Page',
                'page_name' => 'Order',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Order Create Page',
                'page_name' => 'Order Create',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Purchase Page',
                'page_name' => 'Purchase',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Purchase Create Page',
                'page_name' => 'Purchase Create',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Duty Weekly Page',
                'page_name' => 'Duty Weekly',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Duty Create Page',
                'page_name' => 'Duty Create',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Duty Monthly Page',
                'page_name' => 'Duty Monthly',
                'guard_name' => 'web',
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
                'name' => 'Manager',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Analyser',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Staff',
                'guard_name' => 'web',

            ],
        ]);




            
        DB::table('model_has_roles')->insert([
            [
                'role_id' => 1,
                'model_type' => 'App\Models\User',
                'model_id' => 1,
            ],
            [
                'role_id' => 2,
                'model_type' => 'App\Models\User',
                'model_id' => 2,
            ],
            [
                'role_id' => 3,
                'model_type' => 'App\Models\User',
                'model_id' => 3,
            ],
        ]);

        DB::table('role_has_permissions')->insert([
            [
                'permission_id' => 1,
                'role_id' => 1,
            ],
            [
                'permission_id' => 2,
                'role_id' => 1,
            ],
            [
                'permission_id' => 3,
                'role_id' => 1,
            ],
            [
                'permission_id' => 4,
                'role_id' => 1,
            ],
            [
                'permission_id' => 5,
                'role_id' => 1,
            ],
            [
                'permission_id' => 6,
                'role_id' => 1,
            ],
            [
                'permission_id' => 7,
                'role_id' => 1,
            ],
            [
                'permission_id' => 8,
                'role_id' => 1,
            ],
            [
                'permission_id' => 9,
                'role_id' => 1,
            ],
            [
                'permission_id' => 10,
                'role_id' => 1,
            ],
            [
                'permission_id' => 11,
                'role_id' => 1,
            ],
            [
                'permission_id' => 12,
                'role_id' => 1,
            ],
            [
                'permission_id' => 13,
                'role_id' => 1,
            ],
            [
                'permission_id' => 14,
                'role_id' => 1,
            ],
            [
                'permission_id' => 15,
                'role_id' => 1,
            ],
            [
                'permission_id' => 16,
                'role_id' => 1,
            ],
            [
                'permission_id' => 17,
                'role_id' => 1,
            ],
            [
                'permission_id' => 18,
                'role_id' => 1,
            ],
            [
                'permission_id' => 19,
                'role_id' => 1,
            ],
            [
                'permission_id' => 20,
                'role_id' => 1,
            ],
            [
                'permission_id' => 21,
                'role_id' => 1,
            ],
            [
                'permission_id' => 22,
                'role_id' => 1,
            ],
            [
                'permission_id' => 23,
                'role_id' => 1,
            ],
            [
                'permission_id' => 24,
                'role_id' => 1,
            ],
            [
                'permission_id' => 25,
                'role_id' => 1,
            ],
            [
                'permission_id' => 26,
                'role_id' => 1,
            ],
            [
                'permission_id' => 27,
                'role_id' => 1,
            ],
            [
                'permission_id' => 28,
                'role_id' => 1,
            ],
            [
                'permission_id' => 29,
                'role_id' => 1,
            ],
            [
                'permission_id' => 30,
                'role_id' => 1,
            ],
            [
                'permission_id' => 31,
                'role_id' => 1,
            ],
            [
                'permission_id' => 32,
                'role_id' => 1,
            ],
            [
                'permission_id' => 33,
                'role_id' => 1,
            ],
            [
                'permission_id' => 34,
                'role_id' => 1,
            ],
            [
                'permission_id' => 35,
                'role_id' => 1,
            ],
            [
                'permission_id' => 36,
                'role_id' => 1,
            ],
            [
                'permission_id' => 37,
                'role_id' => 1,
            ],
            [
                'permission_id' => 38,
                'role_id' => 1,
            ],
            [
                'permission_id' => 39,
                'role_id' => 1,
            ],
            [
                'permission_id' => 40,
                'role_id' => 1,
            ],
            [
                'permission_id' => 41,
                'role_id' => 1,
            ],
            [
                'permission_id' => 42,
                'role_id' => 1,
            ],
            [
                'permission_id' => 43,
                'role_id' => 1,
            ],
            [
                'permission_id' => 44,
                'role_id' => 1,
            ],
            [
                'permission_id' => 45,
                'role_id' => 1,
            ],
            [
                'permission_id' => 46,
                'role_id' => 1,
            ],
            [
                'permission_id' => 47,
                'role_id' => 1,
            ],
            [
                'permission_id' => 48,
                'role_id' => 1,
            ],
            [
                'permission_id' => 49,
                'role_id' => 1,
            ],
            [
                'permission_id' => 50,
                'role_id' => 1,
            ],
            [
                'permission_id' => 51,
                'role_id' => 1,
            ],
            [
                'permission_id' => 52,
                'role_id' => 1,
            ],
            [
                'permission_id' => 53,
                'role_id' => 1,
            ],
            [
                'permission_id' => 54,
                'role_id' => 1,
            ],
            [
                'permission_id' => 55,
                'role_id' => 1,
            ],
            [
                'permission_id' => 56,
                'role_id' => 1,
            ],
            [
                'permission_id' => 57,
                'role_id' => 1,
            ],
            [
                'permission_id' => 58,
                'role_id' => 1,
            ],
            [
                'permission_id' => 59,
                'role_id' => 1,
            ],
            [
                'permission_id' => 60,
                'role_id' => 1,
            ],
            [
                'permission_id' => 61,
                'role_id' => 1,
            ],
            [
                'permission_id' => 62,
                'role_id' => 1,
            ],
            [
                'permission_id' => 63,
                'role_id' => 1,
            ],
            [
                'permission_id' => 64,
                'role_id' => 1,
            ],
            [
                'permission_id' => 65,
                'role_id' => 1,
            ],
            [
                'permission_id' => 66,
                'role_id' => 1,
            ],
            [
                'permission_id' => 67,
                'role_id' => 1,
            ],
            [
                'permission_id' => 68,
                'role_id' => 1,
            ],
            [
                'permission_id' => 69,
                'role_id' => 1,
            ],
            [
                'permission_id' => 70,
                'role_id' => 1,
            ],
            [
                'permission_id' => 71,
                'role_id' => 1,
            ],
            [
                'permission_id' => 72,
                'role_id' => 1,
            ],
            [
                'permission_id' => 73,
                'role_id' => 1,
            ],
            [
                'permission_id' => 74,
                'role_id' => 1,
            ],
            [
                'permission_id' => 75,
                'role_id' => 1,
            ],
            [
                'permission_id' => 76,
                'role_id' => 1,
            ],
            [
                'permission_id' => 77,
                'role_id' => 1,
            ],
            [
                'permission_id' => 78,
                'role_id' => 1,
            ],
            [
                'permission_id' => 79,
                'role_id' => 1,
            ],
            [
                'permission_id' => 80,
                'role_id' => 1,
            ],
            [
                'permission_id' => 81,
                'role_id' => 1,
            ],
            [
                'permission_id' => 82,
                'role_id' => 1,
            ],
            [
                'permission_id' => 83,
                'role_id' => 1,
            ],
            [
                'permission_id' => 84,
                'role_id' => 1,
            ],
            [
                'permission_id' => 85,
                'role_id' => 1,
            ],
            [
                'permission_id' => 86,
                'role_id' => 1,
            ],
            [
                'permission_id' => 87,
                'role_id' => 1,
            ],
            [
                'permission_id' => 88,
                'role_id' => 1,
            ],
            [
                'permission_id' => 89,
                'role_id' => 1,
            ],
            [
                'permission_id' => 90,
                'role_id' => 1,
            ],
            [
                'permission_id' => 91,
                'role_id' => 1,
            ],
            [
                'permission_id' => 92,
                'role_id' => 1,
            ],
            [
                'permission_id' => 93,
                'role_id' => 1,
            ],
            [
                'permission_id' => 94,
                'role_id' => 1,
            ],
            [
                'permission_id' => 95,
                'role_id' => 1,
            ],
            [
                'permission_id' => 96,
                'role_id' => 1,
            ],
            [
                'permission_id' => 97,
                'role_id' => 1,
            ],
            [
                'permission_id' => 98,
                'role_id' => 1,
            ],
            [
                'permission_id' => 99,
                'role_id' => 1,
            ],
            [
                'permission_id' => 100,
                'role_id' => 1,
            ],
            [
                'permission_id' => 101,
                'role_id' => 1,
            ],
            [
                'permission_id' => 102,
                'role_id' => 1,
            ],
            [
                'permission_id' => 103,
                'role_id' => 1,
            ],
            [
                'permission_id' => 104,
                'role_id' => 1,
            ],
            [
                'permission_id' => 105,
                'role_id' => 1,
            ],
            [
                'permission_id' => 106,
                'role_id' => 1,
            ],
            [
                'permission_id' => 107,
                'role_id' => 1,
            ],
            [
                'permission_id' => 108,
                'role_id' => 1,
            ],
            [
                'permission_id' => 109,
                'role_id' => 1,
            ],
            [
                'permission_id' => 110,
                'role_id' => 1,
            ],
            [
                'permission_id' => 111,
                'role_id' => 1,
            ],
            [
                'permission_id' => 1,
                'role_id' => 2,
            ],
            [
                'permission_id' => 2,
                'role_id' => 2,
            ],
            [
                'permission_id' => 3,
                'role_id' => 2,
            ],
            [
                'permission_id' => 4,
                'role_id' => 2,
            ],
            [
                'permission_id' => 5,
                'role_id' => 2,
            ],
            [
                'permission_id' => 6,
                'role_id' => 2,
            ],
            [
                'permission_id' => 7,
                'role_id' => 2,
            ],
            [
                'permission_id' => 8,
                'role_id' => 2,
            ],
            [
                'permission_id' => 9,
                'role_id' => 2,
            ],
            [
                'permission_id' => 1,
                'role_id' => 3,
            ],
            [
                'permission_id' => 4,
                'role_id' => 3,
            ],
            [
                'permission_id' => 5,
                'role_id' => 3,
            ],
            [
                'permission_id' => 6,
                'role_id' => 3,
            ],
            [
                'permission_id' => 7,
                'role_id' => 3,
            ],
            [
                'permission_id' => 8,
                'role_id' => 3,
            ],
            [
                'permission_id' => 9,
                'role_id' => 3,
            ],
            [
                'permission_id' => 3,
                'role_id' => 4,
            ],
            [
                'permission_id' => 4,
                'role_id' => 4,
            ],
            [
                'permission_id' => 5,
                'role_id' => 4,
            ],
            [
                'permission_id' => 6,
                'role_id' => 4,
            ],
            [
                'permission_id' => 7,
                'role_id' => 4,
            ],
            [
                'permission_id' => 8,
                'role_id' => 4,
            ],
            [
                'permission_id' => 9,
                'role_id' => 4,
            ],
            
            [
                'permission_id' => 1,
                'role_id' => 5,
            ],
            [
                'permission_id' => 2,
                'role_id' => 5,
            ],
            [
                'permission_id' => 3,
                'role_id' => 5,
            ],
            [
                'permission_id' => 5,
                'role_id' => 5,
            ],
            [
                'permission_id' => 6,
                'role_id' => 5,
            ],
        ]);

    }
}
