<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerRatingController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\DropProductController;
use App\Http\Controllers\ProductSellTypeController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PaymentSystemController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DutyStatusController;
use App\Http\Controllers\EmployeeDutyController;
use App\Http\Controllers\EmployeePaymentTypeController;
use App\Http\Controllers\EmployeePaymentController;
use App\Http\Controllers\EmployeeSalaryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ExpenseMonthlyController;
use App\Http\Controllers\ExpenseTypeController;
use App\Http\Controllers\SettingController;
use App\Models\category;
use App\Models\setting;
use Illuminate\Http\Request;
use App\Http\Controllers\ReturnProductController;
use App\Models\Product;
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
Route::get('getjson',function(){
    return Product::all();
})->name('getJson');
Route::post('test-submit',function(Request $request){
    return $request;
})->name('testSubmit');

Route::view('/test-form','testForm');
Route::get('/', function () {

$a = '[{
    "componentDetails":{
        "title":"Category List",
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

            "create":"1",
            "read":"1",
            "update":"1",
            "require":"0",

            "name":"name",
            "input_type" : "text",
            "database_name":"name",  
            "title":"Name"
        },{
            
            "position":111,

            "create":"1",
            "read":"0",
            "update":"2",
            "require":"1",

           "input_type":"text",
           "name":"products_count",
           "title":"Products",


           "database_name":"products_count"
        },{
            
            "position":1,

            "create":"1",
            "read":"1",
            "update":"1",
            "require":"1",

           "input_type":"text",
           "name":"description",
           "database_name":"description",
           "title": "Description"
        },{
            
            "position":12,

            "create":"0",
            "read":"0",
            "update":"0",
            "require":"1",

           "input_type":"date",
           "name":"date",
           "database_name":"date",
           "title": "Date"
        },{
            
            "position":12,

            "create":"0",
            "read":"0",
            "update":"0",
            "require":"1",

           "input_type":"datetime-local",
           "name":"date_time",
           "database_name":"date_time",
           "title": "Date time"
        },{
            
            "position":120,

            "create":"0",
            "read":"0",
            "update":"0",
            "require":"1",

           "input_type":"time",
           "name":"time",
           "database_name":"time",
           "title": "Time"
        },{
            
            "position":2,

            "create":"0",
            "read":"0",
            "update":"0",
            "require":"1",

           "input_type":"month",
           "name":"month",
           "database_name":"month",
           "title": "Month"
        },{
            
            "position":3,

            "create":"0",
            "read":"0",
            "update":"0",
            "require":"1",

           "input_type":"dropDown",
           "name":"product_type_name",
           "database_name":"product_type_id",
           "title": "Type",
           "data" : "product_types"
        }
    ]
}]' ;




$category= setting::find(1);
$category->setting= json_encode( $a);
$category->save();
$data = '{"data":{"_token":"vTnMdXuSbA2phDBY0vZWDzz4qgrbX1kpmoQkxm5S","description":{"position":"1","create":"0","read":"1","update":"1"},"name":{"position":"11","create":"1","read":"0","update":"1"},"products_count":{"position":"111","create":"1","read":"0","update":"0"}}}';
// return json_decode($data,true);
$category= setting::find(1);
$setting = json_decode( json_decode($category->setting,true),true);
return $setting['0'];
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
Route::resource('return_products',ReturnProductController::class);
Route::resource('suppliers',SupplierController::class);
Route::resource('customers',CustomerController::class);
Route::resource('customer_ratings',CustomerRatingController::class);
Route::resource('sell_type',ProductSellTypeController::class);
Route::resource('payment_systems',PaymentSystemController::class);

Route::resource('employees',EmployeeController::class);
Route::resource('designations',DesignationController::class);
Route::resource('employee_payment_types',EmployeePaymentTypeController::class);
Route::resource('employee_payments',EmployeePaymentController::class);
Route::resource('employee_salaries',EmployeeSalaryController::class);

Route::resource('duty_status',DutyStatusController::class);
Route::resource('employee_duties',EmployeeDutyController::class);
Route::get('employee_duties_monthly', [EmployeeDutyController::class, 'dutyMonthly']);
Route::resource('drop_products',DropProductController::class);


Route::resource('expense',ExpenseController::class);
Route::resource('expense_type',ExpenseTypeController::class);
Route::resource('expense_monthly',ExpenseMonthlyController::class);







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

