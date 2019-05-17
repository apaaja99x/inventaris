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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

//INVENTORY
Route::resource('inventory', 'InventoryController');
//JENIS
Route::resource('jenis', 'JenisController');
//RUANG
Route::resource('ruang', 'RuangController');
//PEMINJAMAN
Route::resource('borrow', 'PeminjamanController');
//PEGAWAI
Route::resource('pegawai', 'PegawaiController');
//USERS
Route::resource('users', 'UsersController');
//LAPORAN
Route::get('/laporan/trs', 'LaporanController@transaksi');
Route::get('/laporan/trs/pdf', 'LaporanController@transaksiPdf');
Route::get('/laporan/trs/excel', 'LaporanController@transaksiExcel');

Route::get('/laporan/barang/pdf', 'LaporanController@barangPdf');
Route::get('/laporan/barang/excel', 'LaporanController@barangExcel');
