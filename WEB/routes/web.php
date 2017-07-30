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

Route::get('/', 'AdminController@ListEvent');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/BLOG',[
	'as' => 'admincp.CreateEvent',
	'uses' => 'HomeController@index'
]);

Route::post('/AddEvent','AdminController@AddEvent')->name('admincp.CreateEvent');
Route::post('/EditEvent','AdminController@EditEvent')->name('admincp.EditEvent');
Route::post('/DeleteEvent','AdminController@DeleteEvent')->name('admincp.DeleteEvent');
Route::post('/ListEvent','AdminController@ListEvent')->name('admincp.ListEvent');