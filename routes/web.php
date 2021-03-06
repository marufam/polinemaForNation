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

// User Route :
Route::get('/', 'BerandaController@index');
Route::post('/pemesanan/create', 'PemesananController@store');
Route::get('/buku/', 'BukuController@index');
Route::get('/buku/{id}', 'BukuController@show');


// Admin Route :

Route::group(['middleware' => 'auth_petugas'], function () {
  Route::get('/admin/', 'Admin\BerandaController@index');
  Route::get('/admin/logout', 'Admin\Auth\LoginController@logout');

  // Kategori Route
  Route::resource('admin/kategori', 'Admin\KategoriController');

  // Petugas Route
  Route::resource('admin/petugas', 'Admin\PetugasController');

  // Buku Route
  Route::resource('admin/buku', 'Admin\BukuController');

  // Pesan Route
  Route::resource('admin/pesan', 'Admin\PesanController');

  // Setting Route
  Route::resource('admin/pengaturan', 'Admin\PengaturanController');
});

Route::group(['middleware' => 'redirect_petugas'], function () {
  Route::get('/admin/login', 'Admin\Auth\LoginController@showLoginForm');
  Route::post('/admin/login', 'Admin\Auth\LoginController@login');
});