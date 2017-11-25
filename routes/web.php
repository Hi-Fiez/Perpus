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
Auth::routes();

Route::get('/', 'Auth\DaftarBukuController@index');
Route::get('buku/tambah', 'Auth\DaftarBukuController@create');
Route::get('buku/{id}', 'Auth\DaftarBukuController@show');
Route::get('buku/{id}/edit', 'Auth\DaftarBukuController@edit');
Route::post('buku/export', 'Auth\DaftarBukuController@export');
Route::post('buku/tambah', 'Auth\DaftarBukuController@store');
Route::post('buku/edit', 'Auth\DaftarBukuController@update');
Route::post('buku/{id}/destroy', 'Auth\DaftarBukuController@destroy');

Route::get('stok/tambah', 'Auth\StokBukuController@create');
Route::post('stok/tambah', 'Auth\StokBukuController@store');
Route::post('stok/export', 'Auth\StokBukuController@export');

Route::get('pinjam', 'PeminjamanController@index');
Route::get('pinjam/tambah', 'PeminjamanController@create');
Route::post('pinjam/tambah', 'PeminjamanController@store');
Route::get('pinjam/{id}/edit', 'PeminjamanController@edit');
Route::post('pinjam/{id}/edit', 'PeminjamanController@update');
Route::post('pinjam/export', 'PeminjamanController@export');
