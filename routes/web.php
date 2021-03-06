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
Route::get('/', function () {
    return view('welcome');
});

/**
 * admin
 */
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', 'IndexController@index')->name('admin');
    Route::post('/user/login', 'UserController@login');
    Route::post('/user/check', 'UserController@checkUser');
    Route::post('/user/logout', 'UserController@logout');
 
 });

 Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/category', 'CategoryController@index');
    //Route::post('/user', 'UserController@update');
 });
 
