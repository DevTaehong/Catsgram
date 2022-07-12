<?php

/*
|---------------------------------------------------------------------------
| Web Routes
|---------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', 'HomeController@index');


Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/{id}', 'HomeController@show')->name('home.show');

Route::group(['middleware' => 'IsAdmin'], function () {
    Route::get('/admin/users', 'UserController@index');
});


Route::resource('/themes', 'ThemeController');
Route::resource('/users', 'UserController');

Route::get('/admin/users', 'UserController@index');
Route::get('/admin/users/create', 'UserController@create');
Route::post('/admin/users', 'UserController@store');
Route::get('/admin/users/{users}', 'UserController@show');
Route::get('/admin/users/{user}/edit', 'UserController@edit');
Route::patch('/admin/users/{user}/', 'UserController@update');
Route::delete('/admin/users/{user}/', 'UserController@destroy');

Route::resource('/posts', 'PostController');
Route::patch('/posts/{post}/', 'PostController@update');
Route::delete('/posts/{post}/', 'PostController@destroy');


