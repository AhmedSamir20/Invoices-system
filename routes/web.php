<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------/
|                              Web Routes                                  /
|--------------------------------------------------------------------------/
*/




Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
//Auth::routes(['register' => false]);
Route::get('/home', 'HomeController@index')->name('home');



Route::group(['namespace' => 'Invoices'],function (){
    //=======================Invoices==============================
    Route::resource('invoices','InvoiceController');

    //=======================Invoices Details=======================
    Route::get('InvoicesDetails/{id}', 'InvoicesDetailsController@edit');
    Route::get('View_file/{invoice_number}/{file_name}', 'InvoicesDetailsController@open_file');
    Route::get('download/{invoice_number}/{file_name}', 'InvoicesDetailsController@get_file');
    Route::delete('delete_file', 'InvoicesDetailsController@destroy')->name('delete_file');
    //=======================save Attachments=======================
    Route::post('InvoiceAttachments', 'InvoiceAttachmentsController@store');

    // route to get product related to section with AJAX
    Route::get('section/{id}', 'InvoiceController@getproducts');



    //-----------------------Status payment------------------------
    Route::get('Status_Show/{id}','InvoiceController@show')->name('Status_Show');
    Route::post('Status_Update/{id}','InvoiceController@Status_Update')->name('Status_Update');
    //-----------------------paid Invoices-------------------------
    Route::get('Invoice_Paid','InvoiceController@Invoice_Paid')->name('Invoice_Paid');
    //-----------------------Unpaid Invoices------------------------
    Route::get('Invoice_UnPaid','InvoiceController@Invoice_UnPaid')->name('Invoice_UnPaid');
    //-----------------------Part paid Invoices---------------------
    Route::get('Invoice_Partial','InvoiceController@Invoice_Partial')->name('Invoice_Partial');
    //-----------------------Print Invoices-------------------------
    Route::get('Invoice/Print/{id}','InvoiceController@Invoice_Print')->name('Invoice_Print');
    //-----------------------export Invoices-------------------------
    Route::get('Invoice/export/', 'InvoiceController@export')->name('invoice.export');



    //=====================Archive Route============================
    Route::get('Archive','InvoiceArchiveController@index')->name('Archive.index');
    Route::post('Archive/update/{id}','InvoiceArchiveController@ReturnFromArchive')->name('Archive.update');
    Route::delete('Archive/delete/{id}','InvoiceArchiveController@DeleteFromArchive')->name('Archive.delete');



});

//=======================Section=======================
Route::group(['namespace' => 'Section'],function (){
    route::resource('Sections','SectionController');
});

//=======================Products=======================
Route::group(['namespace' => 'Products'],function (){
    route::resource('Products','ProductController');
});

//=======================Route Role=======================
Route::group(['middleware' => ['auth'] ,'namespace' => 'Role'], function() {
    Route::resource('roles','RoleController');
});
//=======================Route User=======================
Route::group(['middleware' => ['auth'],'namespace' => 'User'], function() {
    Route::resource('users','UserController');
});


//=======================Route Report=======================
Route::group(['middleware' => ['auth'],'prefix' => 'invoice', 'namespace' => 'Reports'], function() {
    Route::get('/reports','invoicesReportController@index')->name('report.index');
    Route::post('/Search','invoicesReportController@searchInvoices')->name('search.invoices');



    Route::get('/customer','CustomersReportController@index')->name('customer.index');
    Route::post('/customer/Search','CustomersReportController@searchInvoices')->name('search.customer');
});
Route::get('/{page}', 'AdminController@index');
