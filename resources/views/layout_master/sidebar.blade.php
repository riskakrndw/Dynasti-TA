  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <div class="user-panel">
          <li class="text-center">
            <img src="{{url('dist/img/logo.jpeg')}}" class="img-circle" alt="User Image">
          </li>
        </div>
        <li class="header">MAIN NAVIGATION</li>

        @if(Auth::user()->level == "manager")
          <li class="@yield("beranda")"><a href="{{route('beranda')}}"><i class="fa fa-home"></i> <span>Beranda</span></a></li>
          <li class="treeview @yield("master")">
            <a href="#">
              <i class="fa fa-th-large"></i> <span>Master Data</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="@yield("jenis")"><a href="{{route('jenis')}}"><i class="fa fa-list"></i> Data Jenis</a></li>
              <li class="@yield("rasa")"><a href="{{route('rasa')}}"><i class="fa fa-list"></i> Data Rasa</a></li>
              <li class="@yield("bahan")"><a href="{{route('bahan')}}"><i class="fa fa-list"></i> Data Bahan Baku</a></li>
              <li class="@yield("es")"><a href="{{route('icecream')}}"><i class="fa fa-list"></i> Data Ice Cream</a></li>
            </ul>
          </li>
          <li class="treeview @yield("transaksi")">
            <a href="#">
              <i class="fa fa-cart-plus"></i> <span>Transaksi</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="@yield("beli")"><a href="{{route('pembelian')}}"><i class="fa fa-list"></i> Data Pengadaan</a></li>
              <li class="@yield("jual")"><a href="{{route('penjualan')}}"><i class="fa fa-list"></i> Data Penjualan</a></li>
            </ul>
          </li>
          <li class="treeview @yield("pemesanan")">
            <a href="#">
              <i class="fa fa-cart-plus"></i> <span>Pemesanan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="@yield("pesanan")"><a href="{{route('pemesanan')}}"><i class="fa fa-list"></i> Data Pemesanan</a></li>
              <li class="@yield("produkpesanan")"><a href="{{route('produkpesanan')}}"><i class="fa fa-list"></i> Data Produk Pesanan</a></li>
            </ul>
          </li>
          <li class="treeview @yield("produksi")">
            <a href="#">
              <i class="fa fa-cart-plus"></i> <span>Produksi</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="@yield("dataproduksi")"><a href="{{route('produksi')}}"><i class="fa fa-list"></i> Data Produksi</a></li>
              <li class="@yield("produkproduksi")"><a href="{{route('produkproduksi')}}"><i class="fa fa-list"></i> Data Produk Produksi</a></li>
            </ul>
          </li>
          <li class="treeview @yield("laporan")">
            <a href="#">
              <i class="fa fa-folder"></i> <span>Laporan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="@yield("lapbeli")"><a href="{{route('laporanPembelian')}}"><i class="fa fa-file"></i> Laporan Pengadaan</a></li>
              <li class="@yield("lapjual")"><a href="{{route('laporanPenjualan')}}"><i class="fa fa-file"></i> Laporan Penjualan</a></li>
              <li class="@yield("lappesan")"><a href="{{route('laporanPemesanan')}}"><i class="fa fa-file"></i> Laporan Pemesanan</a></li>
              <li class="@yield("lappro")"><a href="{{route('laporanProduksi')}}"><i class="fa fa-file"></i> Laporan Produksi</a></li>
              <li class="@yield("lapstokes")"><a href="{{route('laporanEs')}}"><i class="fa fa-file"></i> Laporan Stok Ice Cream</a></li>
              <li class="@yield("lapstokbahan")"><a href="{{route('laporanBahan')}}"><i class="fa fa-file"></i> Laporan Stok Bahan Baku</a></li>
            </ul>
          </li>
          <li class="@yield("user")"><a href="{{route('pengguna')}}"><i class="fa  fa-user-plus"></i> <span>Data Pengguna</span></a></li>



        @elseif(Auth::user()->level == "keuangan")
          <li class="@yield("beranda")"><a href="{{route('berandakeu')}}"><i class="fa fa-home"></i> <span>Beranda</span></a></li>
            <li class="treeview @yield("transaksi")">
              <a href="#">
                <i class="fa fa-cart-plus"></i> <span>Transaksi</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="@yield("beli")"><a href="{{route('pembelianKeu')}}"><i class="fa fa-list"></i> Data Pengadaan</a></li>
                <li class="@yield("jual")"><a href="{{route('penjualanKeu')}}"><i class="fa fa-list"></i> Data Penjualan</a></li>
              </ul>
            </li>



        @elseif(Auth::user()->level == "pengadaan")
          <li class="@yield("berandapeng")"><a href="{{route('berandapeng')}}"><i class="fa fa-home"></i> <span>Beranda</span></a></li>
          <li class="treeview @yield("stok")">
            <a href="#">
              <i class="fa fa-exclamation-circle"></i> <span>Data Stok</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="@yield("stokbahan")"><a href="{{route('bahanpeng')}}"><i class="fa fa-list"></i> Bahan Baku</a></li>
              <li class="@yield("stokes")"><a href="{{route('icecreampeng')}}"><i class="fa fa-list"></i> Ice Cream</a></li>
            </ul>
          </li>
          <li class="treeview @yield("pemesananpeng")">
            <a href="#">
              <i class="fa fa-cart-plus"></i> <span>Pemesanan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="@yield("pesananpeng")"><a href="{{route('pemesananpeng')}}"><i class="fa fa-list"></i> Data Pemesanan</a></li>
              <li class="@yield("produkpesananpeng")"><a href="{{route('produkpesananpeng')}}"><i class="fa fa-list"></i> Data Produk Pesanan</a></li>
            </ul>
          </li>
          <li class="@yield("pembelianPeng")"><a href="{{route('pembelianPeng')}}"><i class="fa  fa-cart-plus"></i> <span>Permintaan Pengadaan</span></a></li>
        

        
        @elseif(Auth::user()->level == "produksi")
          <li class="@yield("berandapro")"><a href="{{route('berandapro')}}"><i class="fa fa-home"></i> <span>Beranda</span></a></li>
          <li class="treeview @yield("produksipro")">
            <a href="#">
              <i class="fa fa-cart-plus"></i> <span>Produksi</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="@yield("dataproduksipro")"><a href="{{route('produksiPro')}}"><i class="fa fa-list"></i> Data Produksi</a></li>
              <li class="@yield("produkproduksipro")"><a href="{{route('produkproduksiPro')}}"><i class="fa fa-list"></i> Data Produk Produksi</a></li>
            </ul>
          </li>
        @endif
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>