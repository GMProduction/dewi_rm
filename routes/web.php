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

Route::get('/', 'Auth\AuthController@index');
Route::get('/logout', 'Auth\AuthController@logout');
Route::post('/postlogin', 'Auth\AuthController@login');
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

Route::get('/admin/admin', 'User\AdminController@index');
Route::get('/admin/admin/add', 'User\AdminController@addForm');
Route::get('/admin/admin/edit/{id}', 'User\AdminController@editForm');
Route::post('/admin/admin/store', 'User\AdminController@add');
Route::post('/admin/admin/patch', 'User\AdminController@patch');
Route::post('/admin/admin/destroy/{id}', 'User\AdminController@destroy');

Route::get('/admin/dokter', 'User\DokterController@index');
Route::get('/admin/dokter/add', 'User\DokterController@addForm');
Route::get('/admin/dokter/edit/{id}', 'User\DokterController@editForm');
Route::post('/admin/dokter/store', 'User\DokterController@add');
Route::post('/admin/dokter/patch', 'User\DokterController@patch');
Route::post('/admin/dokter/destroy/{id}', 'User\DokterController@destroy');

Route::get('/admin/obat', 'Main\ObatController@index');
Route::get('/admin/obat/add', 'Main\ObatController@addForm');
Route::get('/admin/obat/edit/{id}', 'Main\ObatController@editForm');
Route::post('/admin/obat/store', 'Main\ObatController@add');
Route::post('/admin/obat/patch', 'Main\ObatController@patch');
Route::post('/admin/obat/destroy/{id}', 'Main\ObatController@destroy');

Route::get('/admin/diagnosa', 'Transaction\DiagnosaController@index');
Route::get('/admin/diagnosa/list', 'Transaction\DiagnosaController@laporan');
Route::get('/admin/diagnosa/add', 'Transaction\DiagnosaController@addForm');
Route::post('/admin/diagnosa/store', 'Transaction\DiagnosaController@add');

Route::get('/admin/report/diagnosa', 'Transaction\DiagnosaController@formLaporan');
Route::get('/admin/report/diagnosa/print', 'Transaction\DiagnosaController@cetak');
Route::get('/admin/report/rekam-medis', 'Laporan\RekamMedisController@index');
Route::get('/admin/report/rekam-medis/list', 'Laporan\RekamMedisController@laporan');
Route::get('/admin/report/rekam-medis/print', 'Laporan\RekamMedisController@cetak');

Route::get('/admin/resep', 'Transaction\ResepController@index');
Route::get('/admin/resep/add', 'Transaction\ResepController@addForm');
Route::get('/admin/resep/detail/{id}', 'Transaction\ResepController@detail');
Route::get('/admin/resep/cetak/{id}', 'Transaction\ResepController@detailCetak');
Route::post('/admin/resep/store', 'Transaction\ResepController@add');
Route::post('/admin/resep/save', 'Transaction\ResepController@save');
Route::post('/admin/resep/destroyobat/{id}', 'Transaction\ResepController@destroyObat');
