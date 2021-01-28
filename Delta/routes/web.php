<?php

use App\Http\Controllers\AnalysisController;
use App\Http\Controllers\BarCodeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerDueReceiveController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\DropProductController;
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
use App\Http\Controllers\GoalController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PosSettingController;
use App\Http\Controllers\ReturnFromCustomerController;

use App\Http\Controllers\SettingController;
use Illuminate\Http\Request;
use App\Http\Controllers\ReturnToSupplierController;
use App\Http\Controllers\SellAnalysisDailyController;
use App\Http\Controllers\SupplierDuePayController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\userRoleController;
use App\Http\Controllers\WarrentyController;
use App\Models\Product;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

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





Route::get('getjson', function () {
    return Product::all();
})->name('getJson');
Route::post('test-submit', function (Request $request) {
    return $request;
})->name('testSubmit');

Route::view('/test-form', 'testForm');




Route::middleware(['auth'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');





Route::get('/', [IndexController::class, 'index'])->name('home');

Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('orders', OrderController::class);
Route::resource('purchases', PurchaseController::class);
Route::resource('brands', BrandController::class);
Route::resource('units', UnitController::class);
Route::resource('suppliers', SupplierController::class);
Route::resource('customers', CustomerController::class);
// Route::resource('customer_ratings', CustomerRatingController::class);
Route::resource('payment_systems', PaymentSystemController::class);
Route::resource('bar-codes', BarCodeController::class);
Route::resource('goals', GoalController::class);
Route::resource('users', UserController::class);

Route::resource('return-to-suppliers', ReturnToSupplierController::class);
Route::resource('return-from-customers', ReturnFromCustomerController::class);

Route::resource('customer-due-receives', CustomerDueReceiveController::class);
Route::resource('supplier-due-pays', SupplierDuePayController::class);



Route::resource('warrenties', WarrentyController::class);
Route::resource('drop_products', DropProductController::class);
Route::get('stock_alert', [ProductController::class, 'lowStockProduct'])->name('stock_alert');

//Employees
Route::resource('employees', EmployeeController::class);
Route::resource('designations', DesignationController::class);


// Payments     
Route::resource('employee_payment_types', EmployeePaymentTypeController::class);
Route::resource('employee_payments', EmployeePaymentController::class);
Route::resource('employee_salaries', EmployeeSalaryController::class);

// Duties  
Route::resource('duty-statuses', DutyStatusController::class);
Route::resource('employee_duties', EmployeeDutyController::class);
Route::get('employee_duties_monthly', [EmployeeDutyController::class, 'dutyMonthly']);

// Expenses
Route::resource('expenses', ExpenseController::class);
Route::resource('expense-types', ExpenseTypeController::class);
Route::resource('expense-monthlies', ExpenseMonthlyController::class);

// analysis
Route::get('sell-analysis', [SellAnalysisDailyController::class, 'index'])->name('sell-analysis');
Route::get('analysis', [AnalysisController::class, 'index']);


//   Permission Route

Route::resource('user-roles', userRoleController::class);


Route::post('role-permission-store', [userRoleController::class, 'rolepermissionstore'])->name('rolepermissionstore');






Route::resource('settings', SettingController::class);






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
// Route::get('customers_due_api', [CustomerController::class, 'customersDue']);


Route::resource('pos-setting',PosSettingController::class);

Route::get('permission-test',function(){
    
    // $role = Role::find(5);
    // // return $role->hasPermissionTo('Brand Delete');
    // $permissions = $role->permissions()->where('route_name','brands')->get();
    // return $permissions;
    // $permission = $permissions->where('name','Create')->first();
    // return $permission;
    // return $permissions;

    return view('permissions.test');
});

///// testing 
Route::get("chart", function () {

    // $a = '[{
    //     "label": " TK " ,
    //     labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
    //     data: [-12, 19, 3, 5, 2, 3]
    // }]' ;

    $labels = ['Jeans', 'Shirt', 'T-shirt1', 'Polo-shirt', 'Pant', 'Shoe',];
    $data = [67, 12, 43, 25, 44, 55];
    $dataArray = [
        'label' => "asdfasfas",
        "lebels" => $labels,
        'data' => $data,

    ];

    $dataArray = json_encode($dataArray);

    return view('test.chart', compact('dataArray'));
});


Route::get('sync-test', function () {
    
    
    
  
    $connected = @fsockopen("www.example.com", 80); 
                                        //website, port  (try 80 or 443)
    if ($connected){
        $is_conn = 'true'; //action when connected
        fclose($connected);
    }else{
        $is_conn = 'false'; //action in connection failure
    }
    return $is_conn;



    // $datas = onlineSync::all();
    // foreach ($datas as $data) {
    //     $data->data = $data->model::find($data->reference_id);
    //     $response = Http::withBasicAuth('admin@abasas.tech', '1234')->retry(3, 5)->post('https://demos.abasas.tech/saas/Delta/public/api/sync-database', [
    //         'data' => $data
    //     ]);
    //     if ($response->status() == 200) {
    //         $data->delete();
    //     }
    // }
});
