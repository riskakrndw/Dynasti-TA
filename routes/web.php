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
    return view('auth.login');
});

Auth::routes();

//forbidden
Route::get('/forbidden', function()
{
	return view('forbidden');
});

//apibahan
Route::get('/api/bahan', 'BahanApiController@index')->name('apibahan');
Route::get('/api/bahan/{id}', 'BahanApiController@show')->name('apibahanshow');
Route::get('/api/namaBahan/{id}', 'BahanApiController@reqNamaBahan')->name('apinamabahan');

//apiicecream
Route::get('/api/icecream', 'IceCreamApiController@index')->name('apiicecream');
Route::get('/api/icecream/{id}', 'IceCreamApiController@show')->name('apiicecreamshow');
Route::get('/api/namaIceCream/{id}', 'IceCreamApiController@reqNamaIceCream')->name('apinamaicecream');

//beranda
Route::get('/beranda', 'HomeController@index')->name('beranda');
Route::get('/keuangan/beranda', 'HomeController@index')->name('berandakeu');
Route::get('/produksi/beranda', 'HomeController@index')->name('berandapro');
Route::get('/pengadaan/beranda', 'HomeController@index')->name('berandapeng');

//pengguna
Route::get('/manager/pengguna', 'PenggunaController@index')->name('pengguna');
Route::post('/manager/pengguna/simpan', 'PenggunaController@store')->name('tambahPengguna');
Route::get('/manager/pengguna/hapus/{id}', 'PenggunaController@destroy')->name('hapusPengguna');
Route::post('/manager/pengguna/edit', 'PenggunaController@update');

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

//icecream
	/*menampilkan halaman es*/
		Route::get('/icecream', 'IceCreamController@index')->name('icecream');
	/*menampilkan form tambah*/
		Route::get('/icecream/tambah', 'IceCreamController@tambah')->name('tambahEs');
	/*melakukan create*/
		Route::post('/icecream/simpan', 'IceCreamController@store');
		Route::post('/icecream/simpan1', 'IceCreamController@store1');
	/*melakukan delete*/
		Route::get('/icecream/hapus/{id}', 'IceCreamController@destroy')->name('hapusIceCream');
	/*melakukan lihat detail*/
		Route::get('/icecream/lihat/{id}', 'IceCreamController@show');
	/*melakukan ubah*/
		Route::post('/icecream/hapusDetailBahan', 'IceCreamController@hapusDetailBahan')->name('hapusDetailBahan');
		Route::get('/icecream/edit/{id}', 'IceCreamController@showEdit');
		Route::post('/icecream/ubah', 'IceCreamController@ubah');
		Route::post('/icecream/ubah1', 'IceCreamController@ubah1');

//pembelian
	/*menampilkan halaman pembelian*/
		Route::get('/pembelian', 'PembelianController@index')->name('pembelian');
	/*menampilkan form tambah*/
		Route::get('/pembelian/tambah', 'PembelianController@tambah')->name('tambahBeli');
	/*melakukan create*/
		Route::get('/pembelian/simpan/{kode}/{pengguna}/{datepicker}/{total}', 'PembelianController@store');
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
		Route::get('/penjualan/simpan/{kode}/{pengguna}/{datepicker}/{total}', 'PenjualanController@store');
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


//KEUANGAN
//pembelian
	/*menampilkan halaman pembelian*/
		Route::get('/keuangan/pembelian', 'Keuangan\PembelianController@index')->name('pembeliankeu');
	/*menampilkan form tambah*/
		Route::get('/keuangan/pembelian/tambah', 'Keuangan\PembelianController@tambah')->name('tambahBelikeu');
	/*melakukan create*/
		Route::get('/keuangan/pembelian/simpan/{kode}/{datepicker}/{total}', 'Keuangan\PembelianController@store');
		Route::get('/keuangan/pembelian/simpan1/{idbeli}/{namabahan}/{jumlah}/{subtotal}', 'Keuangan\PembelianController@store1');
	/*melakukan delete*/
		Route::get('/keuangan/pembelian/hapus/{id}', 'Keuangan\PembelianController@destroy')->name('hapusPembeliankeu');
	/*melakukan lihat detail*/
		Route::get('/keuangan/pembelian/lihat/{id}', 'Keuangan\PembelianController@show');
	/*melakukan ubah*/
		Route::get('/keuangan/pembelian/hapusDetailPembelian/{id}', 'Keuangan\PembelianController@hapusDetailPembelian')->name('hapusDetailPembeliankeu');
		Route::get('/keuangan/pembelian/edit/{id}', 'Keuangan\PembelianController@showEdit');
		Route::get('/keuangan/pembelian/ubah/{id_beli}/{kode}/{datepicker}/{total}', 'Keuangan\PembelianController@ubah');

//penjualan
	/*menampilkan halaman penjualan*/
		Route::get('/keuangan/penjualan', 'Keuangan\PenjualanController@index')->name('penjualankeu');
	/*menampilkan form tambah*/
		Route::get('/keuangan/penjualan/tambah', 'Keuangan\PenjualanController@tambah')->name('tambahJualkeu');
	/*melakukan create*/
		Route::get('/keuangan/penjualan/simpan/{kode}/{datepicker}/{total}', 'Keuangan\PenjualanController@store');
		Route::get('/keuangan/penjualan/simpan1/{idjual}/{namaes}/{jumlah}/{subtotal}', 'Keuangan\PenjualanController@store1');
	/*melakukan delete*/
		Route::get('/keuangan/penjualan/hapus/{id}', 'Keuangan\PenjualanController@destroy')->name('hapusPenjualankeu');
	/*melakukan lihat detail*/
		Route::get('/keuangan/penjualan/lihat/{id}', 'Keuangan\PenjualanController@show');
	/*melakukan ubah*/
		Route::get('/keuangan/penjualan/hapusDetailPenjualan/{id}', 'Keuangan\PenjualanController@hapusDetailPenjualan')->name('hapusDetailPenjualankeu');
		Route::get('/keuangan/penjualan/edit/{id}', 'Keuangan\PenjualanController@showEdit');
		Route::get('/keuangan/penjualan/ubah/{id_jual}/{kode}/{datepicker}/{total}', 'Keuangan\PenjualanController@ubah');


//PENGADAAN
//jenis
Route::get('/pengadaan/jenis', 'JenisController@index')->name('jenispeng');
Route::post('/pengadaan/jenis/simpan', 'JenisController@store');
Route::get('/pengadaan/jenis/hapus/{id}', 'JenisController@destroy')->name('hapusJenispeng');
Route::post('/pengadaan/jenis/edit', 'JenisController@update');

//rasa
Route::get('/pengadaan/rasa', 'RasaController@index')->name('rasapeng');
Route::post('/pengadaan/rasa/simpan', 'RasaController@store');
Route::get('/pengadaan/rasa/hapus/{id}', 'RasaController@destroy')->name('hapusRasapeng');
Route::post('/pengadaan/rasa/edit', 'RasaController@update');

//bahan
Route::get('/pengadaan/bahan', 'BahanController@index')->name('bahanpeng');
Route::post('/pengadaan/bahan/simpan', 'BahanController@store');
Route::get('/pengadaan/bahan/hapus/{id}', 'BahanController@destroy')->name('hapusBahanpeng');
Route::post('/pengadaan/bahan/edit', 'BahanController@update');

//icecream
	/*menampilkan halaman es*/
		Route::get('/pengadaan/icecream', 'IceCreamController@index')->name('icecreampeng');
	/*menampilkan form tambah*/
		Route::get('/pengadaan/icecream/tambah', 'IceCreamController@tambah')->name('tambahEspeng');
	/*melakukan create*/
		Route::post('/pengadaan/icecream/simpan', 'IceCreamController@store');
		Route::post('/pengadaan/icecream/simpan1', 'IceCreamController@store1');
	/*melakukan delete*/
		Route::get('/pengadaan/icecream/hapus/{id}', 'IceCreamController@destroy')->name('hapusIceCreampeng');
	/*melakukan lihat detail*/
		Route::get('/pengadaan/icecream/lihat/{id}', 'IceCreamController@show');
	/*melakukan ubah*/
		Route::post('/pengadaan/icecream/hapusDetailBahan', 'IceCreamController@hapusDetailBahan')->name('hapusDetailBahanpeng');
		Route::get('/pengadaan/icecream/edit/{id}', 'IceCreamController@showEdit');
		Route::post('/pengadaan/icecream/ubah', 'IceCreamController@ubah');
		Route::post('/pengadaan/icecream/ubah1', 'IceCreamController@ubah1');


