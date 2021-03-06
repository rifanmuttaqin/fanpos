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

// Landing Page Home
Route::get('/', ['as'=>'home', 'uses' => 'HomeController@index']);

// Group Auth controller
$router->group(['prefix' => 'auth', 'namespace'=>'Auth'], function () use ($router) {
    $router->get('/login',  ['uses' => 'LoginController@showLoginForm']);
    $router->post('/login',  ['as'=>'login', 'uses' => 'LoginController@login']); // eksekusi login post method
    $router->get('/logout',  ['uses' => 'LoginController@logout']);
});

// Untuk Home
$router->group(['prefix' => 'home'], function () use ($router) {
	$router->get('/',  ['as'=>'home','uses' => 'HomeController@index']);
    $router->get('/home',  ['as'=>'home-url','uses' => 'HomeController@index']);
});

// Route Customer 
$router->group(['prefix' => 'customer'], function () use ($router) {
	$router->get('/',  ['as'=>'customer-url','uses' => 'CustomerController@index']);
    $router->get('/create',  ['as'=>'create-customer','uses' => 'CustomerController@create']);
    $router->post('/store',  ['as'=>'store-customer', 'uses' => 'CustomerController@store']);
    $router->post('/delete',  ['as'=>'delete-customer','uses' => 'CustomerController@delete']);
    $router->post('/get-detail', ['as'=>'detail-customer', 'uses' => 'CustomerController@show']);
    $router->get('/update/{id}',  ['as'=>'view-update-customer','uses' => 'CustomerController@viewupdate']);
    $router->post('/update',  ['as'=>'doupdatecustomer','uses' => 'CustomerController@doupdate']);
    $router->post('/deleteimage',  ['as'=>'deleteimagecustomer','uses' => 'CustomerController@deleteimage']);
});

// Route Supplier 
$router->group(['prefix' => 'supplier'], function () use ($router) {
    $router->get('/',  ['as'=>'supplier-url','uses' => 'SupplierController@index']);
    $router->get('/create',  ['as'=>'create-supplier','uses' => 'SupplierController@create']);
    $router->post('/store',  ['as'=>'store-supplier', 'uses' => 'SupplierController@store']);
    $router->post('/delete',  ['as'=>'delete-supplier','uses' => 'SupplierController@delete']);
    $router->post('/get-detail', ['as'=>'detail-supplier', 'uses' => 'SupplierController@show']);
    $router->get('/update/{id}',  ['as'=>'view-update','uses' => 'SupplierController@viewupdate']);
    $router->post('/update',  ['as'=>'doupdate','uses' => 'SupplierController@doupdate']);
    $router->post('/deleteimage',  ['as'=>'deleteimagesupplier','uses' => 'SupplierController@deleteimage']);
});

// Untuk Kategori
$router->group(['prefix' => 'kategori'], function () use ($router) {
    $router->get('/',  ['as'=>'kategori-url','uses' => 'KategoriController@index']);
    $router->post('/store',  ['as'=>'store-kategori','uses' => 'KategoriController@store']);
    $router->post('/show',  ['as'=>'show-kategori','uses' => 'KategoriController@show']);
    $router->post('/update',  ['as'=>'update-kategori','uses' => 'KategoriController@update']);
    $router->post('/delete',  ['as'=>'delete-kategori','uses' => 'KategoriController@destroy']);
    $router->post('/list',  ['as'=>'list-kategori','uses' => 'KategoriController@list']);
});

// Untuk Satuan
$router->group(['prefix' => 'satuan'], function () use ($router) {
    $router->get('/',  ['as'=>'satuan-url','uses' => 'SatuanController@index']);
    $router->post('/store',  ['as'=>'store-satuan','uses' => 'SatuanController@store']);
    $router->post('/show',  ['as'=>'show-satuan','uses' => 'SatuanController@show']);
    $router->post('/update',  ['as'=>'update-satuan','uses' => 'SatuanController@update']);
    $router->post('/delete',  ['as'=>'delete-satuan','uses' => 'SatuanController@destroy']);
    $router->post('/list',  ['as'=>'list-satuan','uses' => 'SatuanController@list']);
});

// Untuk Toko
$router->group(['prefix' => 'toko'], function () use ($router) {
    $router->get('/',  ['as'=>'toko','uses' => 'TokoController@index']);
    $router->post('/update',  ['as'=>'update-toko','uses' => 'TokoController@update']);
});

// Untuk Profile
$router->group(['prefix' => 'profile'], function () use ($router) {
    $router->get('/',  ['as'=>'profile','uses' => 'ProfileController@index']);
    $router->post('/update',  ['as'=>'update-profile','uses' => 'ProfileController@update']);
    $router->post('/update-password',  ['as'=>'update-password','uses' => 'ProfileController@updatePassword']);
    $router->post('/deleteimage',  ['as'=>'deleteimage','uses' => 'ProfileController@deleteimage']);
});

// Untuk Management Employee
$router->group(['prefix' => 'employee'], function () use ($router) {
    $router->get('/',  ['as'=>'employee','uses' => 'EmployeeController@index']);
    $router->get('/create',  ['as'=>'create-employee','uses' => 'EmployeeController@create']);
    $router->get('/update/{idemployee}',  ['as'=>'update-employee','uses' => 'EmployeeController@update']);
    $router->post('/update',  ['as'=>'doupdate-employee','uses' => 'EmployeeController@doupdate']);
    $router->post('/store',  ['as'=>'store-employee','uses' => 'EmployeeController@store']);
    $router->post('/update-password',  ['as'=>'employee-update-password','uses' => 'EmployeeController@editPassword']);
    $router->post('/delete',  ['as'=>'delete-employee','uses' => 'EmployeeController@destroy']);
});

// Untuk Produk
$router->group(['prefix' => 'product'], function () use ($router) {
    $router->get('/',  ['as'=>'product','uses' => 'ProductController@index']);
    $router->get('/create',  ['as'=>'create-product','uses' => 'ProductController@create']);
    $router->get('/update/{id}',  ['as'=>'update-product','uses' => 'ProductController@viewupdate']);
    $router->post('/store',  ['as'=>'store-product','uses' => 'ProductController@store']);
    $router->post('/update',  ['as'=>'update-product','uses' => 'ProductController@update']);
    $router->post('/delete',  ['as'=>'delete-product','uses' => 'ProductController@destroy']);
    $router->post('/list',  ['as'=>'list-product','uses' => 'ProductController@list']);
    $router->post('/list-variant',  ['as'=>'list-variant','uses' => 'ProductController@listVariant']);
});

// Untuk Adjustment
$router->group(['prefix' => 'adjustment'], function () use ($router) {
    $router->get('/',  ['as'=>'adjustment','uses' => 'AdjustmentController@index']);
    $router->get('/create',  ['as'=>'create-adjustment','uses' => 'AdjustmentController@create']);
    $router->post('/update-stock',  ['as'=>'update-stock','uses' => 'AdjustmentController@update']);
});
