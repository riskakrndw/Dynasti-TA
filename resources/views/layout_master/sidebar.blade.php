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

        <!-- @if(Auth::user()->level == "manager") -->
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
            <li class="@yield("beli")"><a href="{{route('pembelian')}}"><i class="fa fa-list"></i> Data Pembelian</a></li>
            <li class="@yield("jual")"><a href="{{route('penjualan')}}"><i class="fa fa-list"></i> Data Penjualan</a></li>
          </ul>
        </li>
        <li class="@yield("pesan")"><a href=""><i class="fa fa-calendar-plus-o"></i> <span>Pemesanan</span></a></li>
        <li class="@yield("produksi")"><a href="{{route('produksi')}}"><i class="fa fa-industry"></i> <span>Produksi</span></a></li>
        <li class="treeview @yield("laporan")">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="@yield("lapbeli")"><a href="#"><i class="fa fa-file"></i> Laporan Pembelian</a></li>
            <li class="@yield("lapjual")"><a href="#"><i class="fa fa-file"></i> Laporan Penjualan</a></li>
            <li class="@yield("lapstok")"><a href="#"><i class="fa fa-file"></i> Laporan Stok Barang</a></li>
            <li class="@yield("lapuntungrugi")"><a href="#"><i class="fa fa-file"></i> Laporan Untung Rugi</a></li>
          </ul>
        </li>
        <!-- @elseif(Auth::user()->level == "keuangan")
        <li class="@yield("beranda")"><a href="{{route('berandakeu')}}"><i class="fa fa-home"></i> <span>Beranda</span></a></li>
          <li class="treeview @yield("transaksi")">
            <a href="#">
              <i class="fa fa-cart-plus"></i> <span>Transaksi</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="@yield("beli")"><a href="{{route('pembelian')}}"><i class="fa fa-list"></i> Data Pembelian</a></li>
              <li class="@yield("jual")"><a href="{{route('penjualan')}}"><i class="fa fa-list"></i> Data Penjualan</a></li>
            </ul>
          </li>
          @elseif(Auth::user()->level == "pengadaan")
        <li class="@yield("beranda")"><a href="{{route('berandapeng')}}"><i class="fa fa-home"></i> <span>Beranda</span></a></li>
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
        @endif -->
        <li><a href="documentation/index.html"><i class="fa fa-cog"></i> <span>Pengaturan</span></a></li>
        <li>
          <a href="{{ route('logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
            <i class="fa fa-btn fa-sign-out"></i>
            Logout
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
          </form>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>