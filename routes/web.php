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
    $router->get('/update/{id}',  ['as'=>'view-update','uses' => 'CustomerController@viewupdate']);
    $router->post('/update',  ['as'=>'doupdate','uses' => 'CustomerController@doupdate']);
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
});

// Untuk Kategori
$router->group(['prefix' => 'kategori'], function () use ($router) {
    $router->get('/',  ['as'=>'kategori-url','uses' => 'KategoriController@index']);
    $router->post('/store',  ['as'=>'store-kategori','uses' => 'KategoriController@store']);
    $router->post('/show',  ['as'=>'show-kategori','uses' => 'KategoriController@show']);
    $router->post('/update',  ['as'=>'update-kategori','uses' => 'KategoriController@update']);
    $router->post('/delete',  ['as'=>'delete-kategori','uses' => 'KategoriController@destroy']);
});

// Untuk Satuan
$router->group(['prefix' => 'satuan'], function () use ($router) {
    $router->get('/',  ['as'=>'satuan-url','uses' => 'SatuanController@index']);
    $router->post('/store',  ['as'=>'store-satuan','uses' => 'SatuanController@store']);
    $router->post('/show',  ['as'=>'show-satuan','uses' => 'SatuanController@show']);
    $router->post('/update',  ['as'=>'update-satuan','uses' => 'SatuanController@update']);
    $router->post('/delete',  ['as'=>'delete-satuan','uses' => 'SatuanController@destroy']);
});