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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', [\App\Http\Controllers\Auth\AuthController::class, 'index'])->name('/login');
Route::post('/singin', [\App\Http\Controllers\Auth\AuthController::class, 'doLogin']);
Route::get('/logout', [\App\Http\Controllers\Auth\AuthController::class, 'logout'])->name('/logout');

Route::group(['middleware' => ['app_auth']], static function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index']);

    #user
    Route::get('user', 'UserController@index');
    Route::get('user/create', 'UserController@create');
    Route::post('user', 'UserController@store');
    Route::get('user/{id}', 'UserController@update');
    Route::get('user/{id}/edit', 'UserController@edit');
    Route::get('user/{id}/delete', 'UserController@destroy');

    #kategori ruangan
    Route::get('kategori-ruangan', 'KategoriRuanganController@index');
    Route::get('kategori-ruangan/create', 'KategoriRuanganController@create');
    Route::post('kategori-ruangan', 'KategoriRuanganController@store');
    Route::post('kategori-ruangan/validasi', 'KategoriRuanganController@validasi');
    Route::get('kategori-ruangan/{id}', 'KategoriRuanganController@update');
    Route::get('kategori-ruangan/{id}/edit', 'KategoriRuanganController@edit');
    Route::get('kategori-ruangan/{id}/delete', 'KategoriRuanganController@destroy');

    #hak milik
    Route::get('hak-milik', 'HakMilikController@index');
    Route::get('hak-milik/create', 'HakMilikController@create');
    Route::post('hak-milik', 'HakMilikController@store');
    Route::post('hak-milik/validasi', 'HakMilikController@validasi');
    Route::get('hak-milik/{id}', 'HakMilikController@update');
    Route::get('hak-milik/{id}/edit', 'HakMilikController@edit');
    Route::get('hak-milik/{id}/delete', 'HakMilikController@destroy');

    #fasilitas
    Route::get('fasilitas', 'FasilitasController@index');
    Route::get('fasilitas/create', 'FasilitasController@create');
    Route::post('fasilitas', 'FasilitasController@store');
    Route::post('fasilitas/validasi', 'FasilitasController@validasi');
    Route::get('fasilitas/{id}', 'FasilitasController@update');
    Route::get('fasilitas/{id}/edit', 'FasilitasController@edit');
    Route::get('fasilitas/{id}/delete', 'FasilitasController@destroy');

    #ruangan
    Route::get('ruangan', 'RuanganController@index');
    Route::get('ruangan/create', 'RuanganController@create');
    Route::post('ruangan', 'RuanganController@store');
    Route::post('ruangan/validasi', 'RuanganController@validasi');
    Route::get('ruangan/{id}', 'RuanganController@update');
    Route::get('ruangan/{id}/edit', 'RuanganController@edit');
    Route::get('ruangan/{id}/delete', 'RuanganController@destroy');
    Route::get('ruangan/{id}/detail', 'RuanganController@show');

    #detail ruangan
    Route::post('detail-ruangan', 'DetailRuanganController@store');
    Route::post('detail-ruangan/update', 'DetailRuanganController@update');
    Route::get('detail-ruangan/{id}/delete', 'DetailRuanganController@destroy');

    #peminjaman berdasarkan fitur
    Route::get('pinjam-ruangan', 'PinjamRuanganFiturController@index');
    Route::get('validasi-fitur', 'ValidasiController@cekTanggal');
    Route::post('pinjam-ruangan/filter', 'PinjamRuanganFiturController@filter');
    Route::get('pinjam-ruangan/form/{id}', 'PinjamRuanganFiturController@transaksiPinjam');
    Route::post('pinjam-ruangan', 'PinjamRuanganFiturController@store');

    #peminjaman berdasarkan tanggal
    Route::get('/pinjam-ruangan-calender', 'PinjamRuanganFiturController@calender');

    #peminjaman
    Route::get('/peminjaman', 'PeminjamanController@index');
    Route::get('/peminjaman/{id}/detail', 'PeminjamanController@show');
    Route::get('/peminjaman/{id}', 'PeminjamanController@update');

});
