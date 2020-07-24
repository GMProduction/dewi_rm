<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/admin', 'MainController@index');

Route::get('/admin/pasien', 'User\PasienController@index');
Route::get('/admin/pasien/add', 'User\PasienController@addForm');
Route::get('/admin/pasien/edit/{id}', 'User\PasienController@editForm');
Route::post('/admin/pasien/store', 'User\PasienController@add');
Route::post('/admin/pasien/patch', 'User\PasienController@patch');
Route::post('/admin/pasien/destroy/{id}', 'User\PasienController@destroy');

Route::get('/admin/spesialis', 'Main\SpesialisController@index');
Route::get('/admin/spesialis/add', 'Main\SpesialisController@addForm');
Route::get('/admin/spesialis/edit/{id}', 'Main\SpesialisController@editForm');
Route::post('/admin/spesialis/store', 'Main\SpesialisController@add');
Route::post('/admin/spesialis/patch', 'Main\SpesialisController@patch');
Route::post('/admin/spesialis/destroy/{id}', 'Main\SpesialisController@destroy');
