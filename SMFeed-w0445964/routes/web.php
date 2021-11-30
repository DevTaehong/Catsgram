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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/roles', 'RoleController');
Route::resource('/posts', 'PostController');
Route::resource('/users', 'UserController');

Route::get('/admin/users', 'UserController@index');
Route::get('/admin/users/create', 'UserController@create');
Route::post('/admin/users', 'UserController@store');
Route::get('/admin/users/{users}', 'UserController@show');
Route::get('/admin/users/{user}/edit', 'UserController@edit');
Route::patch('/admin/users/{user}/', 'UserController@update');
Route::delete('/admin/users/{user}/', 'UserController@destroy');

