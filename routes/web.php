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
Route::group(['middleware' => 'prevent-back-history'],function(){

	Route::get('/', function () {
		if(auth() -> user()){
		    if(auth()->user()->level=="manager"){
		        return redirect("/manager/beranda");
		    }
		    elseif(auth()->user()->level=="keuangan"){
		        return redirect("/keuangan/beranda");
		    }
		    elseif(auth()->user()->level=="produksi"){
		        return redirect("/produksi/beranda");
		    }
		    elseif (auth()->user()->level=="pengadaan") {
		        return redirect("/pengadaan/beranda");
		    }
		}else{
			return view('auth.login');
		}
	    
	});

	Auth::routes();

	//forbidden
	Route::get('/forbidden', function()
	{
		return view('forbidden');
	});

	// untuk select 2 ajax
		//apibahan
			Route::get('/api/bahan', 'BahanApiController@index')->name('apibahan');
			Route::get('/api/bahan/{id}', 'BahanApiController@show')->name('apibahanshow');
			Route::get('/api/namaBahan/{id}', 'BahanApiController@reqNamaBahan')->name('apinamabahan');

		//apiicecream
			Route::get('/api/icecream', 'IceCreamApiController@index')->name('apiicecream');
			Route::get('/api/icecreamin', 'IceCreamApiController@indexin')->name('apiicecreamin');
			Route::get('/api/icecream/{id}', 'IceCreamApiController@show')->name('apiicecreamshow');
			Route::get('/api/detail-icecream/{id}', 'IceCreamApiController@showDetail')->name('apiicecreamshowdetail');
			Route::get('/api/namaIceCream/{id}', 'IceCreamApiController@reqNamaIceCream')->name('apinamaicecream');
			Route::get('/api/arraynamaIceCream/{id}/{jumlah}', 'IceCreamApiController@arrayNamaIceCream')->name('apiarraynamaicecream');
			Route::get('/api/getJumlahProduksi/{id_es}/{id_produksi}', 'IceCreamApiController@getJumlahProduksi')->name('getJumlahProduksi');

		//apirasa
			Route::get('/api/rasa', 'RasaApiController@index')->name('apirasa');
			Route::get('/api/rasa/{id}', 'RasaApiController@show')->name('apirasashow');
			Route::get('/api/namaRasa/{id}', 'RasaApiController@reqNamaRasa')->name('apinamarasa');
			Route::get('/api/detail-jenis/{id}', 'RasaApiController@showJenis')->name('apirasashowjenis');
			Route::get('/api/detail-rasa/{id}', 'RasaApiController@showDetail')->name('apirasashowdetail');


	// UNTUK BAGIAN MANAGER
		Route::group(['middleware' => 'levelManager', 'auth'], function(){

			// BERANDA
				Route::get('/manager/beranda', 'HomeController@index_manager')->name('beranda');
				Route::get('/manager/beranda/tahun={tahun}', 'HomeController@grafiktransaksi');
				Route::get('/manager/beranda/{tahun1}', 'HomeController@grafikuntung');
				Route::get('/manager/beranda/terlaris/{tahun}/{bulan}', 'HomeController@pilihTerlaris');

			// PROFIL
				Route::get('/manager/profil', 'ProfilController@index')->name('profilman');
				Route::post('/manager/profil/edit', 'ProfilController@updateData');
				Route::post('/manager/profil/editSandi', 'ProfilController@updateSandi');

			// PENGGUNA
				Route::get('/manager/pengguna', 'PenggunaController@index')->name('pengguna');
				Route::post('/manager/pengguna/simpan', 'PenggunaController@store')->name('tambahPengguna');
				Route::get('/manager/pengguna/hapus/{id}', 'PenggunaController@destroy')->name('hapusPengguna');
				Route::post('/manager/pengguna/edit', 'PenggunaController@updateData');
				Route::post('/manager/pengguna/editSandi', 'PenggunaController@updateSandi');

			// JENIS
				Route::get('/manager/jenis', 'JenisController@index')->name('jenis');
				Route::post('/manager/jenis/simpan', 'JenisController@store');
				Route::get('/manager/jenis/hapus/{id}', 'JenisController@destroy')->name('hapusJenis');
				Route::post('/manager/jenis/edit', 'JenisController@update');

			// RASA
				Route::get('/manager/rasa', 'RasaController@index')->name('rasa');
				Route::post('/manager/rasa/simpan', 'RasaController@store');
				Route::get('/manager/rasa/hapus/{id}', 'RasaController@destroy')->name('hapusRasa');
				Route::post('/manager/rasa/edit', 'RasaController@update');
				/*menampilkan form tambah*/
					Route::get('/manager/rasa/tambah', 'RasaController@tambah')->name('tambahRasa');
				/*melakukan create*/
					Route::post('/manager/rasa/simpan', 'RasaController@store');
					Route::post('/manager/rasa/simpan1', 'RasaController@store1');
					Route::post('/manager/rasa/simpan2', 'RasaController@store2');
					Route::post('/manager/rasa/simpan3', 'RasaController@store3');
				/*melakukan lihat detail*/
					Route::get('/manager/rasa/lihat/{id}', 'RasaController@show');
				/*melakukan ubah*/
					Route::get('/manager/rasa/edit/{id}', 'RasaController@showEdit');
				/*melakukan ubah*/
					Route::post('/manager/rasa/hapusDetailRasa', 'RasaController@hapusDetailRasa')->name('hapusDetailRasa');
					Route::post('/manager/rasa/hapusEs', 'RasaController@hapusEs')->name('hapusEs');
					Route::get('/manager/rasa/edit/{id}', 'RasaController@showEdit');
					Route::post('/manager/rasa/ubah', 'RasaController@edit');
					Route::post('/manager/rasa/ubah1', 'RasaController@edit1');
					Route::post('/manager/rasa/ubah2', 'RasaController@edit2');

			//ICECREAM
				/*menampilkan halaman es*/
					Route::get('/manager/icecream', 'IceCreamController@index')->name('icecream');
				/*menampilkan form tambah*/
					Route::get('/manager/icecream/tambah', 'IceCreamController@tambah')->name('tambahEs');
				/*melakukan create*/
					Route::post('/manager/icecream/simpan', 'IceCreamController@store');
					Route::post('/manager/icecream/simpan1', 'IceCreamController@store1');
				/*melakukan delete*/
					Route::get('/manager/icecream/hapus/{id}', 'IceCreamController@destroy')->name('hapusIceCream');
				/*melakukan lihat detail*/
					Route::get('/manager/icecream/lihat/{id}', 'IceCreamController@show');
				/*melakukan ubah*/
					Route::post('/manager/icecream/hapusDetailBahan', 'IceCreamController@hapusDetailBahan')->name('hapusDetailBahan');
					Route::get('/manager/icecream/edit/{id}', 'IceCreamController@showEdit');
					Route::post('/manager/icecream/ubah', 'IceCreamController@ubah');
					Route::post('/manager/icecream/ubah1', 'IceCreamController@ubah1');
				// ubah stok
					Route::post('/manager/icecream/edit', 'IceCreamController@update');
					Route::post('/manager/icecream/edit/stokmin', 'IceCreamController@updateMin');

			//BAHAN
				Route::get('/manager/bahan', 'BahanController@index')->name('bahan');
				Route::post('/manager/bahan/simpan', 'BahanController@store');
				Route::get('/manager/bahan/hapus/{id}', 'BahanController@hapus')->name('hapusBahan');
				Route::post('/manager/bahan/edit', 'BahanController@update');

			//PEMBELIAN
				/*menampilkan halaman pembelian*/
					Route::get('/manager/pembelian', 'PembelianController@index')->name('pembelian');
				/*menampilkan form tambah*/
					Route::get('/manager/pembelian/tambah', 'PembelianController@tambah')->name('tambahBeli');
				/*melakukan create*/
					Route::get('/manager/pembelian/simpan/{pengguna}/{total}', 'PembelianController@store');
					Route::get('/manager/pembelian/simpan1/{idbeli}/{namabahan}/{jumlah}/{subtotal}', 'PembelianController@store1');
				/*melakukan delete*/
					Route::get('/manager/pembelian/hapus/{id}', 'PembelianController@destroy')->name('hapusPembelian');
				/*melakukan lihat detail*/
					Route::get('/manager/pembelian/lihat/{id}', 'PembelianController@show');
				/*melakukan ubah*/
					Route::get('/manager/pembelian/hapusDetailPembelian/{id}', 'PembelianController@hapusDetailPembelian')->name('hapusDetailPembelian');
					Route::get('/manager/pembelian/edit/{id}', 'PembelianController@showEdit');
					Route::get('/manager/pembelian/ubah/{id_beli}/{pengguna}/{datepicker}/{waktu}/{total}', 'PembelianController@ubah');
				// ubah status pembelian
					Route::post('/manager/pembelian/disetujui', 'PembelianController@pembelianDisetujui');
					Route::post('/manager/pembelian/ditolak', 'PembelianController@pembelianDitolak');
					Route::post('/manager/pembelian/dibeli', 'PembelianController@pembelianDibeli');
					Route::post('/manager/pembelian/gagal', 'PembelianController@pembelianGagal');
					Route::post('/manager/pembelian/diterima', 'PembelianController@pembelianDiterima');

			//PERMINTAAN
					Route::get('/manager/konfirmasi', 'PembelianController@konfirmasi')->name('konfirmasi');
				/*melakukan lihat detail*/
					Route::get('/manager/konfirmasi/lihat/{id}', 'PembelianController@show');
					Route::post('/manager/konfirmasi/disetujui', 'PembelianController@pembelianDisetujui');
					Route::post('/manager/konfirmasi/ditolak', 'PembelianController@pembelianDitolak');

			//STOK BAHAN
				Route::get('/manager/stok-bahan', 'HomeController@stokBahan')->name('stokBahan');

			//STOK ES
				Route::get('/manager/stok-ice', 'HomeController@stokIce')->name('stokIce');

			//PENJUALAN
				/*menampilkan halaman penjualan*/
					Route::get('/manager/penjualan', 'PenjualanController@index')->name('penjualan');
				/*menampilkan form tambah*/
					Route::get('/manager/penjualan/tambah', 'PenjualanController@tambah')->name('tambahJual');
				/*melakukan create*/
					Route::get('/manager/penjualan/simpan/{pengguna}/{total}', 'PenjualanController@store');
					Route::get('/manager/penjualan/simpan1/{idjual}/{namaes}/{jumlah}/{subtotal}', 'PenjualanController@store1');
				/*melakukan delete*/
					Route::get('/manager/penjualan/hapus/{id}', 'PenjualanController@destroy')->name('hapusPenjualan');
				/*melakukan lihat detail*/
					Route::get('/manager/penjualan/lihat/{id}', 'PenjualanController@show');
				/*melakukan ubah*/
					Route::get('/manager/penjualan/hapusDetailPenjualan/{id}', 'PenjualanController@hapusDetailPenjualan')->name('hapusDetailPenjualan');
					Route::get('/manager/penjualan/edit/{id}', 'PenjualanController@showEdit');
					Route::get('/manager/penjualan/ubah/{id_jual}/{pengguna}/{datepicker}/{total}', 'PenjualanController@ubah');

			//PRODUKSI
				/*menampilkan halaman produksi*/
					Route::get('/manager/produksi', 'ProduksiController@index')->name('produksi');
				/*menampilkan halaman produk produksi*/
					Route::get('/manager/produk-produksi', 'ProduksiController@index1')->name('produkproduksi');
				/*menampilkan form tambah*/
					Route::get('/manager/produksi/tambah', 'ProduksiController@tambah')->name('tambahProduksi');
				/*melakukan lihat detail*/
					Route::get('/manager/produksi/lihat/{id}/{tipe}', 'ProduksiController@show');
				/*melakukan create*/
					Route::get('/manager/produksi/simpan/{pengguna}', 'ProduksiController@store');
					Route::get('/manager/produksi/simpan1/{ides}/{idproduksi}/{jumlahproduksi}', 'ProduksiController@store1');
					Route::get('/manager/produksi/simpan2/{jumlah}/{idbahan}', 'ProduksiController@store2');
				// ubah modal
					Route::post('/manager/produksi/edit', 'ProduksiController@update');
				/*melakukan ubah*/
					Route::get('/manager/produksi/edit/{id}', 'ProduksiController@showEdit');
					// Route::get('/manager/produksi/ubah/{idproduksi}/{ides}/{pengguna}/{kode}/{datepicker}/{jumlah}/{idbahan}', 'ProduksiController@ubah');
				/*melakukan ubah fix*/
					Route::post('/manager/produksi/ubah', 'ProduksiController@edit');
					Route::post('/manager/produksi/ubah1', 'ProduksiController@edit1');


			//PEMESANAN
				/*menampilkan halaman produk pesanan*/
					Route::get('/manager/produk-pesanan', 'PemesananController@index')->name('produkpesanan');
				/*menampilkan halaman pemesanan*/
					Route::get('/manager/pemesanan', 'PemesananController@index1')->name('pemesanan');
				/*menampilkan form tambah*/
					Route::get('/manager/pemesanan/tambah', 'PemesananController@tambah')->name('tambahPemesanan');
				/*melakukan create*/
					Route::get('/manager/pemesanan/simpan/{pengguna}/{nama}/{alamat}/{telepon}/{datepicker}/{total}', 'PemesananController@store');
					Route::get('/manager/pemesanan/simpan1/{idpesan}/{namaes}/{jumlah}/{subtotal}', 'PemesananController@store1');
				// ubah status pemesanan
					Route::get('/manager/pemesanan/selesai/{idpesanan}', 'PemesananController@pemesananSelesai');
					Route::get('/manager/pemesanan/batal/{idpesanan}', 'PemesananController@pemesananBatal');
				// ubah status detail pemesanan
					Route::get('/manager/pemesanan/detail/siap/{ides}/{jumlahes}/{iddetailpemesanan}', 'PemesananController@produkSiap');
				/*melakukan lihat detail*/
					Route::get('/manager/pemesanan/lihat/{id}/{tipe}', 'PemesananController@show');
				// hapus detail pemesanan
					Route::post('/manager/pemesanan/hapusDetailPemesanan', 'PemesananController@hapusDetailPemesanan')->name('hapusDetailPemesanan');
				/*melakukan ubah*/
					Route::get('/manager/pemesanan/edit/{id}', 'PemesananController@showEdit');
					Route::get('/manager/pemesanan/ubah/{id_pesan}/{pengguna}/{nama}/{alamat}/{telepon}/{datepicker}/{total}', 'PemesananController@ubah');
					Route::get('/manager/pemesanan/ubah1/{pemesanan_id}/{namaes}/{jumlah}/{status}/{subtotal}', 'PemesananController@ubah1');
				// melakukan update jumlah
					Route::get('/manager/pemesanan/update/{iddetail}/{jumlahes}', 'PemesananController@updateJumlah');



			//PRINT LAPORAN
				/*menampilkan halaman print laporan*/
					Route::get('/manager/laporan/pengadaan', 'LaporanController@laporanPembelian')->name('laporanPembelian');
					Route::get('/manager/laporan/penjualan', 'LaporanController@laporanPenjualan')->name('laporanPenjualan');
					Route::get('/manager/laporan/pemesanan', 'LaporanController@laporanPemesanan')->name('laporanPemesanan');
					Route::get('/manager/laporan/produksi', 'LaporanController@laporanProduksi')->name('laporanProduksi');
					Route::get('/manager/laporan/ice', 'LaporanController@laporanEs')->name('laporanEs');
					Route::get('/manager/laporan/bahan', 'LaporanController@laporanBahan')->name('laporanBahan');

				// mengambil data saat pencarian data
					Route::post('lappenjualan','LaporanController@lappenjualan');
					Route::post('lappengadaan','LaporanController@lappengadaan');
					Route::post('lappemesanan','LaporanController@lappemesanan');
					Route::post('lapproduksi','LaporanController@lapproduksi');

				// untuk memberi data saat cetak
					Route::get('/manager/laporan/printbahan', 'LaporanController@cetakbahan');
					Route::get('/manager/laporan/printice', 'LaporanController@cetakes');
					Route::get('/manager/laporan/printpengadaan/{tgl_a}/{tgl_b}', 'LaporanController@cetakpengadaan');
					Route::get('/manager/laporan/printpenjualan/{tgl_a}/{tgl_b}', 'LaporanController@cetakpenjualan');
					Route::get('/manager/laporan/printpemesanan/{tgl_a}/{tgl_b}', 'LaporanController@cetakpemesanan');
					Route::get('/manager/laporan/printproduksi/{tgl_a}/{tgl_b}', 'LaporanController@cetakproduksi');
		});
		


	// UNTUK BAGIAN KEUANGAN
		Route::group(['middleware' => 'levelKeuangan', 'auth'], function(){

			//PROFIL
				Route::get('/keuangan/profil', 'ProfilController@index')->name('profilkeu');
				Route::post('/keuangan/profil/edit', 'ProfilController@updateData');
				Route::post('/keuangan/profil/editSandi', 'ProfilController@updateSandi');

			//BERANDA
				Route::get('/keuangan/beranda', 'HomeController@index_keuangan')->name('berandakeu');
				Route::get('/keuangan/beranda/tahun={tahun}', 'HomeController@index_keuangan');
				Route::get('/keuangan/beranda/tahun={tahun}', 'HomeController@grafiktransaksikeu');

			//PERMINTAAN
				// menampilkan halaman permintaan konfirmasi
					Route::get('/keuangan/konfirmasi', 'PembelianController@konfirmasikeu')->name('konfirmasikeu');
				/*melakukan lihat detail*/
					Route::get('/keuangan/konfirmasi/lihat/{id}', 'PembelianController@show');
					Route::post('/keuangan/konfirmasi/ubah', 'PembelianController@ubahStatusKeu');

			//PEMBELIAN
				/*menampilkan halaman pembelian*/
					Route::get('/keuangan/pembelian', 'PembelianController@index')->name('pembelianKeu');
				/*menampilkan form tambah*/
					Route::get('/keuangan/pembelian/tambah', 'PembelianController@tambah')->name('tambahBeliKeu');
				/*melakukan create*/
					Route::get('/keuangan/pembelian/simpan/{pengguna}/{total}', 'PembelianController@store');
					Route::get('/keuangan/pembelian/simpan1/{idbeli}/{namabahan}/{jumlah}/{subtotal}', 'PembelianController@store1');
				/*melakukan delete*/
					Route::get('/keuangan/pembelian/hapus/{id}', 'PembelianController@destroy')->name('hapusPembelianKeu');
				/*melakukan lihat detail*/
					Route::get('/keuangan/pembelian/lihat/{id}', 'PembelianController@show');
				/*melakukan ubah*/
					Route::get('/keuangan/pembelian/hapusDetailPembelian/{id}', 'PembelianController@hapusDetailPembelian')->name('hapusDetailPembelianKeu');
					Route::get('/keuangan/pembelian/edit/{id}', 'PembelianController@showEdit');
					Route::get('/keuangan/pembelian/ubah/{id_beli}/{pengguna}/{datepicker}/{waktu}/{total}/{status}', 'PembelianController@ubah');
				// ubah status
					Route::post('/keuangan/pembelian/dibeli', 'PembelianController@pembelianDibeli');
					Route::post('/keuangan/pembelian/gagal', 'PembelianController@pembelianGagal');

			//PENJUALAN
				/*menampilkan halaman penjualan*/
					Route::get('/keuangan/penjualan', 'PenjualanController@index')->name('penjualanKeu');
				/*menampilkan form tambah*/
					Route::get('/keuangan/penjualan/tambah', 'PenjualanController@tambah')->name('tambahJualKeu');
				/*melakukan create*/
					Route::get('/keuangan/penjualan/simpan/{pengguna}/{total}', 'PenjualanController@store');
					Route::get('/keuangan/penjualan/simpan1/{idjual}/{namaes}/{jumlah}/{subtotal}', 'PenjualanController@store1');
				/*melakukan delete*/
					Route::get('/keuangan/penjualan/hapus/{id}', 'PenjualanController@destroy')->name('hapusPenjualanKeu');
				/*melakukan lihat detail*/
					Route::get('/keuangan/penjualan/lihat/{id}', 'PenjualanController@show');
				/*melakukan ubah*/
					Route::get('/keuangan/penjualan/hapusDetailPenjualan/{id}', 'PenjualanController@hapusDetailPenjualan')->name('hapusDetailPenjualanKeu');
					Route::get('/keuangan/penjualan/edit/{id}', 'PenjualanController@showEdit');
					Route::get('/keuangan/penjualan/ubah/{id_jual}/{pengguna}/{datepicker}/{total}', 'PenjualanController@ubah');
		});


	// UNTUK BAGIAN PENGADAAN
		Route::group(['middleware' => 'levelPengadaan', 'auth'], function(){

			// PENGADAAN
				Route::get('/pengadaan/profil', 'ProfilController@index')->name('profilpeng');
				Route::post('/pengadaan/profil/edit', 'ProfilController@updateData');
				Route::post('/pengadaan/profil/editSandi', 'ProfilController@updateSandi');

			//BERANDA
				Route::get('/pengadaan/beranda', 'HomeController@index_pengadaan')->name('berandapeng');

			//PEMBELIAN
				/*menampilkan halaman pembelian*/
					Route::get('/pengadaan/pembelian', 'PembelianController@index')->name('pembelianPeng');
				/*menampilkan form tambah*/
					Route::get('/pengadaan/pembelian/tambah', 'PembelianController@tambah')->name('tambahBeliPeng');
				/*melakukan create*/
					Route::get('/pengadaan/pembelian/simpan/{pengguna}/{total}', 'PembelianController@store');
					Route::get('/pengadaan/pembelian/simpan1/{idbeli}/{namabahan}/{jumlah}/{subtotal}', 'PembelianController@store1');
				/*melakukan delete*/
					Route::get('/pengadaan/pembelian/hapus/{id}', 'PembelianController@destroy')->name('hapusPembelianPeng');
				/*melakukan lihat detail*/
					Route::get('/pengadaan/pembelian/lihat/{id}', 'PembelianController@show');
				/*melakukan ubah*/
					Route::get('/pengadaan/pembelian/hapusDetailPembelian/{id}', 'PembelianController@hapusDetailPembelian')->name('hapusDetailPembelianPeng');
					Route::get('/pengadaan/pembelian/edit/{id}', 'PembelianController@showEdit');
					Route::get('/pengadaan/pembelian/ubah/{id_beli}/{pengguna}/{datepicker}/{waktu}/{total}/{status}', 'PembelianController@ubah');

				// melakukan konfirmasi penerimaan
					Route::post('/pengadaan/pembelian/diterima', 'PembelianController@pembelianDiterima');

			//STOK BAHAN
				Route::get('/pengadaan/stok-bahan', 'HomeController@stokBahan')->name('stokBahanPengadaan');

			//STOK ES
				Route::get('/pengadaan/stok-ice', 'HomeController@stokIce')->name('stokIcePengadaan');

			//PENERIMAAN
				// menampilkan halaman konfirmasi
					Route::get('/pengadaan/konfirmasi', 'PembelianController@konfirmasipenerimaan')->name('konfirmasipenerimaan');
				/*melakukan lihat detail*/
					Route::get('/pengadaan/konfirmasi/lihat/{id}', 'PembelianController@show');
					Route::post('/pengadaan/konfirmasi/ubah', 'PembelianController@ubahStatusKeu');

			//ICECREAM
				/*menampilkan halaman es*/
					Route::get('/pengadaan/icecream', 'IceCreamController@index')->name('icecreampeng');

			//BAHAN
				Route::get('/pengadaan/bahan', 'BahanController@index')->name('bahanpeng');

			//PEMESANAN
				/*menampilkan halaman produk pesanan*/
					Route::get('/pengadaan/produk-pesanan', 'PemesananController@index')->name('produkpesananpeng');
				/*menampilkan halaman pemesanan*/
					Route::get('/pengadaan/pemesanan', 'PemesananController@index1')->name('pemesananpeng');
				/*menampilkan form tambah*/
					Route::get('/pengadaan/pemesanan/tambah', 'PemesananController@tambah')->name('tambahPemesananpeng');
				/*melakukan create*/
					Route::get('/pengadaan/pemesanan/simpan/{pengguna}/{nama}/{alamat}/{telepon}/{datepicker}/{total}', 'PemesananController@store');
					Route::get('/pengadaan/pemesanan/simpan1/{idpesan}/{namaes}/{jumlah}/{subtotal}', 'PemesananController@store1');
				// ubah status pemesanan
					Route::get('/pengadaan/pemesanan/selesai/{idpesanan}', 'PemesananController@pemesananSelesai');
					Route::get('/pengadaan/pemesanan/batal/{idpesanan}', 'PemesananController@pemesananBatal');
				// ubah status detail pemesanan
					Route::get('/pengadaan/pemesanan/detail/siap/{ides}/{jumlahes}/{iddetailpemesanan}', 'PemesananController@produkSiap');
				/*melakukan lihat detail*/
					Route::get('/pengadaan/pemesanan/lihat/{id}/{tipe}', 'PemesananController@show');
				// hapus detail pemesanan
					Route::post('/pengadaan/pemesanan/hapusDetailPemesanan', 'PemesananController@hapusDetailPemesanan')->name('hapusDetailPemesananpeng');
				/*melakukan ubah*/
					Route::get('/pengadaan/pemesanan/edit/{id}', 'PemesananController@showEdit');
					Route::get('/pengadaan/pemesanan/ubah/{id_pesan}/{pengguna}/{nama}/{alamat}/{telepon}/{datepicker}/{total}', 'PemesananController@ubah');
					Route::get('/pengadaan/pemesanan/ubah1/{pemesanan_id}/{namaes}/{jumlah}/{status}/{subtotal}', 'PemesananController@ubah1');
				// melakukan update jumlah
					Route::get('/pengadaan/pemesanan/update/{iddetail}/{jumlahes}', 'PemesananController@updateJumlah');
		});


	// UNTUK BAGIAN PRODUKSI
		Route::group(['middleware' => 'levelProduksi', 'auth'], function(){

			//PROFIL
				Route::get('/produksi/profil', 'ProfilController@index')->name('profilpro');
				Route::post('/produksi/profil/edit', 'ProfilController@updateData');
				Route::post('/produksi/profil/editSandi', 'ProfilController@updateSandi');

			//BERANDA
				Route::get('/produksi/beranda', 'HomeController@index_produksi')->name('berandapro');

				/*melakukan lihat detail*/
					Route::get('/produksi/pemesanan/lihat/{id}/{tipe}', 'PemesananController@show');
			
			/*melakukan lihat detail pemesanan*/
				Route::get('/produksi/pemesanan/lihat/{id}/{tipe}', 'PemesananController@show');
			
			//PRODUKSI
				/*menampilkan halaman produksi*/
					Route::get('/produksi/produksi', 'ProduksiController@index')->name('produksiPro');
				/*menampilkan halaman produk produksi*/
					Route::get('/produksi/produk-produksi', 'ProduksiController@index1')->name('produkproduksiPro');
				/*menampilkan form tambah*/
					Route::get('/produksi/produksi/tambah', 'ProduksiController@tambah')->name('tambahProduksiPro');
				/*melakukan lihat detail*/
					Route::get('/produksi/produksi/lihat/{id}/{tipe}', 'ProduksiController@show');
				/*melakukan create*/
					Route::get('/produksi/produksi/simpan/{pengguna}', 'ProduksiController@store');
					Route::get('/produksi/produksi/simpan1/{ides}/{idproduksi}/{jumlahproduksi}', 'ProduksiController@store1');
					Route::get('/produksi/produksi/simpan2/{jumlah}/{idbahan}', 'ProduksiController@store2');
				// ubah modal
					Route::post('/produksi/produksi/edit', 'ProduksiController@update');
				/*melakukan ubah*/
					Route::get('/produksi/produksi/edit/{id}', 'ProduksiController@showEdit');
					// Route::get('/manager/produksi/ubah/{idproduksi}/{ides}/{pengguna}/{kode}/{datepicker}/{jumlah}/{idbahan}', 'ProduksiController@ubah');
				/*melakukan ubah fix*/
					Route::post('/produksi/produksi/ubah', 'ProduksiController@edit');
					Route::post('/produksi/produksi/ubah1', 'ProduksiController@edit1');
		});
});

