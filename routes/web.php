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
    return redirect('login');
});

Auth::routes();

// jika ada yang akses route register, baik get maupun post maka akan di redirect ke halaman login
Route::match(['get', 'post'], '/register', function () {
    return redirect('login');
})->name('register');

Route::group(['middleware' => ['auth']], function () {
	Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('user', 'UserController');
    Route::resource('supplier', 'SupplierController')->except(['show']);
    Route::resource('pegawai', 'PegawaiController')->except(['show']);
    Route::resource('kategori', 'KategoriController')->except(['show']);
    Route::resource('transaksi_masuk', 'TransaksiMasukController')->only(['index','create','store','destroy']);
    Route::resource('agen','AgenController')->only(['index']);
    Route::resource('laporan', 'ReportPenjualanController')->only(['index']);
    Route::get('report_pdf','ReportPenjualanController@cetak_pdf')->name('report_pdf');
    Route::get('report_excel','ReportPenjualanController@cetak_excel')->name('report_excel');
    Route::resource('produk', 'ProdukController')->except(['show']);
});


