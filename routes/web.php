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
    Route::post('/auth/login', 'AuthController@authenticate');
    Route::post('/auth/check', 'AuthController@checkUser');
    Route::post('/auth/logout', 'AuthController@logout');
 
 });
 
 Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
     Route::resource('/users', 'UserController');
     Route::resource('/category', 'CategoryController');
     Route::resource('/posts', 'PostController');
     Route::resource('/comment', 'CommentController');
     Route::resource('/trashes', 'TrashController');
     Route::post('/', 'IndexController@statistical');
 });