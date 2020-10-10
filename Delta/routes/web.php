<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductSellTypeController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PaymentSystemController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DutyStatusController;
use App\Http\Controllers\EmployeeDutyController;
use App\Http\Controllers\EmployeePaymentTypeController;
use App\Http\Controllers\EmployeePaymentController;
use App\Http\Controllers\EmployeeSalaryController;
use App\Http\Controllers\SettingController;
use App\Models\category;
use App\Models\setting;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

$a = '[{
    "componentDetails":{
        "title":"Category list",
        "editTitle":"Edit Category"
    },
    "routes":{
        "create":{
            "name":"categories.create",
            "link":"categories"
        },
        "update":{
            "name":"categories.update",
            "link":"categories"
        },
        "delete":{
            "name":"categories.destroy",
            "link":"categories"
        }
    },
    "fieldList":[{
        
            "position":11,

            "create":true,
            "read":false,
            "update":true,

            "name":"name",
            "input_type" : "text",
            "database_name":"name",  
            "title":"Name"
        },{
            
            "position":111,

            "create":true,
            "read":false,
            "update":false,

           "input_type":"text",
           "name":"products_count",
           "title":"Products"
        },{
            
            "position":1,

            "create":false,
            "read":true,
            "update":true,

           "input_type":"text",
           "name":"description",
           "database_name":"description",
           "title": "Description"
        }
    ]
}]' ;




$category= setting::find(1);
$category->setting= json_encode( $a);
$category->save();
$data = '{"data":{"_token":"vTnMdXuSbA2phDBY0vZWDzz4qgrbX1kpmoQkxm5S","description":{"position":"1","create":"0","read":"1","update":"1"},"name":{"position":"11","create":"1","read":"0","update":"1"},"products_count":{"position":"111","create":"1","read":"0","update":"0"}}}';
return json_decode($data,true);
$category= setting::find(1);
$setting = json_decode( json_decode($category->setting,true),true);
return $setting['0']['fieldList'];
    return view('welcome',compact('category'));
 })->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('categories',CategoryController::class);
Route::resource('products',ProductController::class); 
Route::resource('orders',OrderController::class);
Route::resource('purchases',PurchaseController::class);
Route::resource('brands',BrandController::class);
Route::resource('units',UnitController::class);
Route::resource('product_types',ProductTypeController::class);
Route::resource('suppliers',SupplierController::class);
Route::resource('customers',CustomerController::class);
Route::resource('sell_type',ProductSellTypeController::class);
Route::resource('payment_systems',PaymentSystemController::class);

Route::resource('employees',EmployeeController::class);
Route::resource('employee_payment_types',EmployeePaymentTypeController::class);
Route::resource('employee_payments',EmployeePaymentController::class);
Route::resource('employee_salaries',EmployeeSalaryController::class);

Route::resource('duty_status',DutyStatusController::class);
Route::resource('employee_duties',EmployeeDutyController::class);








Route::resource('settings',SettingController::class);






// Api Area start

Route::get('product_view_api', [ProductController::class, 'ApiShow']);
Route::get('product_check_api', [ProductController::class, 'apiProducutCheck']);

//  Deleted
// Route::get('apisearchproduct', [ProductController::class, 'ApiSearchProduct']); 


Route::get('suppliers_api', [SupplierController::class, 'apiIndex']); 
Route::get('supplier_view_api', [SupplierController::class, 'ApiShow']); 
Route::get('supplierscheck_api', [SupplierController::class, 'supplierCheck']); 
Route::get('suppliersdue_api', [SupplierController::class, 'suppliersDue']); 


Route::get('customers_api', [CustomerController::class, 'apiIndex']); 
Route::get('customer_view_api', [CustomerController::class, 'ApiShow']); 
Route::get('customer_check_api', [CustomerController::class, 'apiCustomerCheck']); 
Route::get('customers_due_api', [CustomerController::class, 'customersDue']); 

