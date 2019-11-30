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
    $router->post('/store',  ['as'=>'store-customer', 'uses' => 'CustomerController@login']);
    $router->get('/delete',  ['as'=>'delete-customer','uses' => 'CustomerController@logout']);
    $router->post('/get-detail', ['as'=>'detail-customer', 'uses' => 'CustomerController@show']);
    $router->get('/update/{id}',  ['as'=>'view-update','uses' => 'CustomerController@viewupdate']);
    $router->post('/update',  ['as'=>'doupdate','uses' => 'CustomerController@doupdate']);
});
