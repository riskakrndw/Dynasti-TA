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
Route::get('/manager/beranda', 'HomeController@index_manager')->name('beranda');
Route::get('/keuangan/beranda', 'HomeController@index_keuangan')->name('berandakeu');
Route::get('/produksi/beranda', 'HomeController@index')->name('berandapro');
Route::get('/pengadaan/beranda', 'HomeController@index_pengadaan')->name('berandapeng');

//profil
Route::get('/manager/profil', 'ProfilController@index')->name('profilman');
Route::post('/manager/profil/edit', 'ProfilController@updateData');

Route::post('/manager/profil/editSandi', 'ProfilController@updateSandi');

//pengguna
Route::get('/manager/pengguna', 'PenggunaController@index')->name('pengguna');
Route::post('/manager/pengguna/simpan', 'PenggunaController@store')->name('tambahPengguna');
Route::get('/manager/pengguna/hapus/{id}', 'PenggunaController@destroy')->name('hapusPengguna');
Route::post('/manager/pengguna/edit', 'PenggunaController@updateData');
Route::post('/manager/pengguna/editSandi', 'PenggunaController@updateSandi');

//jenis
Route::get('/manager/jenis', 'JenisController@index')->name('jenis');
Route::post('/manager/jenis/simpan', 'JenisController@store');
Route::get('/manager/jenis/hapus/{id}', 'JenisController@destroy')->name('hapusJenis');
Route::post('/manager/jenis/edit', 'JenisController@update');

//rasa
Route::get('/manager/rasa', 'RasaController@index')->name('rasa');
Route::post('/manager/rasa/simpan', 'RasaController@store');
Route::get('/manager/rasa/hapus/{id}', 'RasaController@destroy')->name('hapusRasa');
Route::post('/manager/rasa/edit', 'RasaController@update');


Route::group(['middleware' => 'levelManager'], function(){
	//ICECREAM
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

	//BAHAN
		Route::get('/manager/bahan', 'BahanController@index')->name('bahan');
		Route::post('/manager/bahan/simpan', 'BahanController@store');
		Route::get('/manager/bahan/hapus/{id}', 'BahanController@destroy')->name('hapusBahan');
		Route::post('/manager/bahan/edit', 'BahanController@update');

	//PEMBELIAN
		/*menampilkan halaman pembelian*/
			Route::get('/manager/pembelian', 'PembelianController@index')->name('pembelian');
		/*menampilkan form tambah*/
			Route::get('/manager/pembelian/tambah', 'PembelianController@tambah')->name('tambahBeli');
		/*melakukan create*/
			Route::get('/manager/pembelian/simpan/{kode}/{pengguna}/{datepicker}/{total}/{status}', 'PembelianController@store');
			Route::get('/manager/pembelian/simpan1/{idbeli}/{namabahan}/{jumlah}/{subtotal}', 'PembelianController@store1');
		/*melakukan delete*/
			Route::get('/manager/pembelian/hapus/{id}', 'PembelianController@destroy')->name('hapusPembelian');
		/*melakukan lihat detail*/
			Route::get('/manager/pembelian/lihat/{id}', 'PembelianController@show');
		/*melakukan ubah*/
			Route::get('/manager/pembelian/hapusDetailPembelian/{id}', 'PembelianController@hapusDetailPembelian')->name('hapusDetailPembelian');
			Route::get('/manager/pembelian/edit/{id}', 'PembelianController@showEdit');
			Route::get('/manager/pembelian/ubah/{id_beli}/{kode}/{pengguna}/{datepicker}/{total}/{status}', 'PembelianController@ubah');

	//PERMINTAAN
			Route::get('/manager/konfirmasi', 'PembelianController@konfirmasi')->name('konfirmasi');
		/*melakukan lihat detail*/
			Route::get('/manager/konfirmasi/lihat/{id}', 'PembelianController@show');
			Route::post('/manager/konfirmasi/ubah', 'PembelianController@ubahStatus');

	//PENJUALAN
		/*menampilkan halaman penjualan*/
			Route::get('/manager/penjualan', 'PenjualanController@index')->name('penjualan');
		/*menampilkan form tambah*/
			Route::get('/manager/penjualan/tambah', 'PenjualanController@tambah')->name('tambahJual');
		/*melakukan create*/
			Route::get('/manager/penjualan/simpan/{kode}/{pengguna}/{datepicker}/{total}', 'PenjualanController@store');
			Route::get('/manager/penjualan/simpan1/{idjual}/{namaes}/{jumlah}/{subtotal}', 'PenjualanController@store1');
		/*melakukan delete*/
			Route::get('/manager/penjualan/hapus/{id}', 'PenjualanController@destroy')->name('hapusPenjualan');
		/*melakukan lihat detail*/
			Route::get('/manager/penjualan/lihat/{id}', 'PenjualanController@show');
		/*melakukan ubah*/
			Route::get('/manager/penjualan/hapusDetailPenjualan/{id}', 'PenjualanController@hapusDetailPenjualan')->name('hapusDetailPenjualan');
			Route::get('/manager/penjualan/edit/{id}', 'PenjualanController@showEdit');
			Route::get('/manager/penjualan/ubah/{id_jual}/{kode}/{pengguna}/{datepicker}/{total}', 'PenjualanController@ubah');

	//PRODUKSI
		/*menampilkan halaman produksi*/
			Route::get('/manager/produksi', 'ProduksiController@index')->name('produksi');
		/*menampilkan form tambah*/
			Route::get('/manager/produksi/tambah', 'ProduksiController@tambah')->name('tambahProduksi');
		/*melakukan create*/
			Route::get('/manager/produksi/simpan/{kode}/{pengguna}/{datepicker}/{total}', 'ProduksiController@store');
			Route::get('/manager/produksi/simpan1/{idjual}/{namaes}/{jumlah}/{subtotal}', 'ProduksiController@store1');
		/*melakukan delete*/
			Route::get('/manager/produksi/hapus/{id}', 'ProduksiController@destroy')->name('hapusProduksi');
		/*melakukan lihat detail*/
			Route::get('/manager/produksi/lihat/{id}', 'ProduksiController@show');
		/*melakukan ubah*/
			Route::get('/manager/produksi/hapusDetailPenjualan/{id}', 'ProduksiController@hapusDetailProduksi')->name('hapusDetailProduksi');
			Route::get('/manager/produksi/edit/{id}', 'ProduksiController@showEdit');
			Route::get('/manager/produksi/ubah/{id_jual}/{kode}/{pengguna}/{datepicker}/{total}', 'ProduksiController@ubah');
});
	

Route::group(['middleware' => 'levelKeuangan'], function(){
	//PEMBELIAN
		/*menampilkan halaman pembelian*/
			Route::get('/keuangan/pembelian', 'PembelianController@index')->name('pembelianKeu');
		/*menampilkan form tambah*/
			Route::get('/keuangan/pembelian/tambah', 'PembelianController@tambah')->name('tambahBeliKeu');
		/*melakukan create*/
			Route::get('/keuangan/pembelian/simpan/{kode}/{pengguna}/{datepicker}/{total}/{status}', 'PembelianController@store');
			Route::get('/keuangan/pembelian/simpan1/{idbeli}/{namabahan}/{jumlah}/{subtotal}', 'PembelianController@store1');
		/*melakukan delete*/
			Route::get('/keuangan/pembelian/hapus/{id}', 'PembelianController@destroy')->name('hapusPembelianKeu');
		/*melakukan lihat detail*/
			Route::get('/keuangan/pembelian/lihat/{id}', 'PembelianController@show');
		/*melakukan ubah*/
			Route::get('/keuangan/pembelian/hapusDetailPembelian/{id}', 'PembelianController@hapusDetailPembelian')->name('hapusDetailPembelianKeu');
			Route::get('/keuangan/pembelian/edit/{id}', 'PembelianController@showEdit');
			Route::get('/keuangan/pembelian/ubah/{id_beli}/{kode}/{pengguna}/{datepicker}/{total}/{status}', 'PembelianController@ubah');

	//PENJUALAN
		/*menampilkan halaman penjualan*/
			Route::get('/keuangan/penjualan', 'PenjualanController@index')->name('penjualanKeu');
		/*menampilkan form tambah*/
			Route::get('/keuangan/penjualan/tambah', 'PenjualanController@tambah')->name('tambahJualKeu');
		/*melakukan create*/
			Route::get('/keuangan/penjualan/simpan/{kode}/{pengguna}/{datepicker}/{total}', 'PenjualanController@store');
			Route::get('/keuangan/penjualan/simpan1/{idjual}/{namaes}/{jumlah}/{subtotal}', 'PenjualanController@store1');
		/*melakukan delete*/
			Route::get('/keuangan/penjualan/hapus/{id}', 'PenjualanController@destroy')->name('hapusPenjualanKeu');
		/*melakukan lihat detail*/
			Route::get('/keuangan/penjualan/lihat/{id}', 'PenjualanController@show');
		/*melakukan ubah*/
			Route::get('/keuangan/penjualan/hapusDetailPenjualan/{id}', 'PenjualanController@hapusDetailPenjualan')->name('hapusDetailPenjualanKeu');
			Route::get('/keuangan/penjualan/edit/{id}', 'PenjualanController@showEdit');
			Route::get('/keuangan/penjualan/ubah/{id_jual}/{kode}/{pengguna}/{datepicker}/{total}', 'PenjualanController@ubah');
});

Route::group(['middleware' => 'levelPengadaan'], function(){
	//PEMBELIAN
		/*menampilkan halaman pembelian*/
			Route::get('/pengadaan/pembelian', 'PembelianController@index')->name('pembelianPeng');
		/*menampilkan form tambah*/
			Route::get('/pengadaan/pembelian/tambah', 'PembelianController@tambah')->name('tambahBeliPeng');
		/*melakukan create*/
			Route::get('/pengadaan/pembelian/simpan/{kode}/{pengguna}/{datepicker}/{total}/{status}', 'PembelianController@store');
			Route::get('/pengadaan/pembelian/simpan1/{idbeli}/{namabahan}/{jumlah}/{subtotal}', 'PembelianController@store1');
		/*melakukan delete*/
			Route::get('/pengadaan/pembelian/hapus/{id}', 'PembelianController@destroy')->name('hapusPembelianPeng');
		/*melakukan lihat detail*/
			Route::get('/pengadaan/pembelian/lihat/{id}', 'PembelianController@show');
		/*melakukan ubah*/
			Route::get('/pengadaan/pembelian/hapusDetailPembelian/{id}', 'PembelianController@hapusDetailPembelian')->name('hapusDetailPembelianPeng');
			Route::get('/pengadaan/pembelian/edit/{id}', 'PembelianController@showEdit');
			Route::get('/pengadaan/pembelian/ubah/{id_beli}/{kode}/{pengguna}/{datepicker}/{total}/{status}', 'PembelianController@ubah');

	//ICECREAM
		/*menampilkan halaman es*/
			Route::get('/pengadaan/icecream', 'IceCreamController@index')->name('icecreampeng');

	//PENGADAAN
		Route::get('/pengadaan/bahan', 'BahanController@index')->name('bahanpeng');
});

//produksi
	/*menampilkan halaman produksi*/
		Route::get('/manager/produksi', 'ProduksiController@index')->name('produksi');

/*//detailBahan
Route::get('/icecream/tambahBahan/{id_bahan}/{id_es}/{takaran}', 'DetailBahanController@create')->name('tambahBahan');*/
