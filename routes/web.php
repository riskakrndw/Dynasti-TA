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

Route::get('/beranda', 'HomeController@index')->name('beranda');

//jenis
Route::get('/jenis', 'JenisController@index')->name('jenis');
Route::post('/jenis/simpan', 'JenisController@store');
Route::get('/jenis/hapus/{id}', 'JenisController@destroy')->name('hapusJenis');
Route::post('/jenis/edit', 'JenisController@update');

//rasa
Route::get('/rasa', 'RasaController@index')->name('rasa');
Route::post('/rasa/simpan', 'RasaController@store');
Route::get('/rasa/hapus/{id}', 'RasaController@destroy')->name('hapusRasa');
Route::post('/rasa/edit', 'RasaController@update');

//bahan
Route::get('/bahan', 'BahanController@index')->name('bahan');
Route::post('/bahan/simpan', 'BahanController@store');
Route::get('/bahan/hapus/{id}', 'BahanController@destroy')->name('hapusBahan');
Route::post('/bahan/edit', 'BahanController@update');

//apibahan
Route::get('/api/bahan', 'BahanApiController@index')->name('apibahan');
Route::get('/api/bahan/{id}', 'BahanApiController@show')->name('apibahanshow');
Route::get('/api/namaBahan/{id}', 'BahanApiController@reqNamaBahan')->name('apinamabahan');

//apiicecream
Route::get('/api/icecream', 'IceCreamApiController@index')->name('apiicecream');
Route::get('/api/icecream/{id}', 'IceCreamApiController@show')->name('apiicecreamshow');
Route::get('/api/namaIceCream/{id}', 'IceCreamApiController@reqNamaIceCream')->name('apinamaicecream');

//icecream
	/*menampilkan halaman es*/
		Route::get('/icecream', 'IceCreamController@index')->name('icecream');
	/*menampilkan form tambah*/
		Route::get('/icecream/tambah', 'IceCreamController@tambah')->name('tambahEs');
	/*melakukan create*/
		Route::get('/icecream/simpan/{nama}/{harga}/{stok}/{jumlah_produksi}/{id_jenis}/{id_rasa}', 'IceCreamController@store');
		Route::get('/icecream/simpan1/{id_es}/{namabahan}/{takaran}', 'IceCreamController@store1');
	/*melakukan delete*/
		Route::get('/icecream/hapus/{id}', 'IceCreamController@destroy')->name('hapusIceCream');
	/*melakukan lihat detail*/
		Route::get('/icecream/lihat/{id}', 'IceCreamController@show');
	/*melakukan ubah*/
		Route::get('/icecream/hapusDetailBahan/{id}', 'IceCreamController@hapusDetailBahan')->name('hapusDetailBahan');
		Route::get('/icecream/edit/{id}', 'IceCreamController@showEdit');
		Route::get('/icecream/ubah/{id_eskrim}/{nama}/{harga}/{stok}/{jumlah_produksi}/{id_jenis}/{id_rasa}', 'IceCreamController@ubah');

//pembelian
	/*menampilkan halaman pembelian*/
		Route::get('/pembelian', 'PembelianController@index')->name('pembelian');
	/*menampilkan form tambah*/
		Route::get('/pembelian/tambah', 'PembelianController@tambah')->name('tambahBeli');
	/*melakukan create*/
		Route::get('/pembelian/simpan/{kode}/{datepicker}/{total}', 'PembelianController@store');
		Route::get('/pembelian/simpan1/{idbeli}/{namabahan}/{jumlah}/{subtotal}', 'PembelianController@store1');
	/*melakukan delete*/
		Route::get('/pembelian/hapus/{id}', 'PembelianController@destroy')->name('hapusPembelian');
	/*melakukan lihat detail*/
		Route::get('/pembelian/lihat/{id}', 'PembelianController@show');
	/*melakukan ubah*/
		Route::get('/pembelian/hapusDetailPembelian/{id}', 'PembelianController@hapusDetailPembelian')->name('hapusDetailPembelian');
		Route::get('/pembelian/edit/{id}', 'PembelianController@showEdit');
		Route::get('/pembelian/ubah/{id_beli}/{kode}/{datepicker}/{total}', 'PembelianController@ubah');

//penjualan
	/*menampilkan halaman penjualan*/
		Route::get('/penjualan', 'PenjualanController@index')->name('penjualan');
	/*menampilkan form tambah*/
		Route::get('/penjualan/tambah', 'PenjualanController@tambah')->name('tambahJual');
	/*melakukan create*/
		Route::get('/penjualan/simpan/{kode}/{datepicker}/{total}', 'PenjualanController@store');
		Route::get('/penjualan/simpan1/{idjual}/{namaes}/{jumlah}/{subtotal}', 'PenjualanController@store1');
	/*melakukan delete*/
		Route::get('/penjualan/hapus/{id}', 'PenjualanController@destroy')->name('hapusPenjualan');
	/*melakukan lihat detail*/
		Route::get('/penjualan/lihat/{id}', 'PenjualanController@show');
	/*melakukan ubah*/
		Route::get('/penjualan/hapusDetailPenjualan/{id}', 'PenjualanController@hapusDetailPenjualan')->name('hapusDetailPenjualan');
		Route::get('/penjualan/edit/{id}', 'PenjualanController@showEdit');
		Route::get('/penjualan/ubah/{id_jual}/{kode}/{datepicker}/{total}', 'PenjualanController@ubah');

//produksi
	/*menampilkan halaman produksi*/
		Route::get('/produksi', 'ProduksiController@index')->name('produksi');

/*//detailBahan
Route::get('/icecream/tambahBahan/{id_bahan}/{id_es}/{takaran}', 'DetailBahanController@create')->name('tambahBahan');*/