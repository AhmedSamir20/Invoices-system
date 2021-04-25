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
    route::resource('invoices','InvoiceController');
});

Route::group(['namespace' => 'Section'],function (){
    route::resource('Sections','SectionController');
});


Route::group(['namespace' => 'Products'],function (){
    route::resource('Products','ProductController');
});

Route::get('/{page}', 'AdminController@index');
