<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'IndexController@index')->name('index');

Route::get('/profile', 'UserController@index')->name('profile');

Auth::routes();

// Product Area 
Route::resource('categories', 'CategoryController');
Route::post('catagoriesupdate', 'CategoryController@catagoriesupdate')->name("catagoriesupdate");

Route::resource('product_type', 'ProductTypeController');
Route::post('product_typeupdate', 'ProductTypeController@Product_typeupdate')->name("product_typeupdate");

Route::resource('products', 'ProductController');
Route::post('productsupdate', 'ProductController@Productsupdate')->name("productsupdate");
Route::get('productsdrop', 'ProductController@productsdrop')->name("productsdrop");
Route::get('complete-product', 'ProductController@complete')->name("complete-product");

Route::resource('purchases', 'PurchaseController');
Route::resource('purchases_details', 'PurchaseDetailsController');
Route::get('purchases-receipt-show/{id}', 'ReceiptController@purchaseShow')->name('purchases-receipt-show');

Route::resource('orders', 'OrderController');
Route::resource('orders_details', 'OrderDetailController');
Route::get('order-receipt-show/{id}', 'ReceiptController@orderShow')->name('order-receipt-show');
Route::resource('order_return_product', 'OrderReturnProductController');

Route::resource('invoices', 'InvoiceController');


Route::resource('suppliers', 'SupplierController');
Route::post('suppliers_update', 'SupplierController@suppliersupdate')->name("suppliersupdate");
Route::get('supplier_payment', 'SupplierController@suppplierPayment')->name("supplier_payment");
Route::post('supplier_payment', 'SupplierController@suppplierPaymentStore')->name("supplier_paymnent_store");
Route::get('supplier_payment_all', 'SupplierController@supplierPaymentIndex')->name("supplier_paymnent_store_all");

// end Product area 

// customer area start
Route::resource('customers', 'CustomerController');
Route::post('customers_update', 'CustomerController@customersupdate')->name("customersupdate");
Route::get('customer_cash_receive_create', 'CustomerController@customersCashReceiveCreate')->name("customer_cash_receive_create");
Route::post('customer_cash_receive', 'CustomerController@customersCashReceiveStore')->name("customer_cash_receive_store");
Route::get('customer_cash_receive_all', 'CustomerController@customersCashReceiveIndex')->name("customer_cash_receive_all");

// customer area end

// barcode print  area start
Route::get('barcode', 'BarCodePrinterController@index')->name("barcode");
Route::post('barcode_print', 'BarCodePrinterController@print')->name("barcode_print");

// barcode print  area end

// testing  routes

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/testrelation', 'UserController@index')->name('home');
Route::view('/table','table');
Route::view('/bar','bar');






// api route 




Route::get('apicategories', 'CategoryController@apiIndex')->name('categories_api');
Route::get('apiproduct_types', 'ProductTypeController@apiIndex')->name('product_type_api');
Route::get('apiproduct', 'ProductController@ApiShow')->name('product_view_api');
Route::get('apiproduct_check', 'ProductController@apiProducutCheck')->name("product_check_api");

Route::get('apisuppliers', 'SupplierController@apiIndex')->name('suppliers_api');
Route::get('apisupplier', 'SupplierController@ApiShow')->name('supplier_view_api');
Route::get('apisupplierscheck', 'SupplierController@supplierscheck')->name("supplierscheck_api");
Route::get('apisuppliersdue', 'SupplierController@suppliersDue')->name("suppliersdue_api");

Route::get('apicustomers', 'CustomerController@apiIndex')->name('customers_api');
Route::get('apicustomer', 'CustomerController@ApiShow')->name('customer_view_api');
Route::get('apicustomer_check', 'CustomerController@apiCustomerCheck')->name("customer_check_api");
Route::get('apicustomersdue_api', 'CustomerController@customersDue')->name("customersdue_api");