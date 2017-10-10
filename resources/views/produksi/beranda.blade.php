@extends('layout_master.master')

@section("title", "Bagian Produksi | Beranda")

@section("berandapro", "active")

@section("content")
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Beranda
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Beranda</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Alert Success -->
        <div class="callout callout-info">
          <h4>Halo {{Auth::user()->name}}!</h4>
          <p>Selamat Datang di Halaman Bagian Produksi</p>
        </div>
      <!-- /Alert Success -->

      <!-- Info beranda -->
        <div class="row">
          <div class="col-md-12">
            <section class="connectedSortable">
                <div class="box">
                  <div class="nav-tabs-custom">
                    <div class="box-header">
                      <ul class="nav nav-tabs-custom">
                        <li class="pull-left header"><i class="fa fa-info-circle"></i> Ice cream yang harus segera diproduksi</li>
                        <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                      </ul>
                    </div>
                    <div class="box-body table-responsive">
                      <table id="example1" class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama Ice Cream</th>
                            <th>Stok</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $no=1; ?>
                          @foreach($data as $data)
                            @if($data->stok < $data->stok_min)
                              <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->stok }}</td>
                              </tr>
                            @endif
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
            </section>
          </div>
        </div>
      <!-- /Info beranda -->

      <!-- informasi pemesanan -->
        <div class="row">
          <br>
          <div class="col-md-12">
            <section class="connectedSortable">
                <div class="box">
                  <div class="nav-tabs-custom">
                    <div class="box-header">
                      <ul class="nav nav-tabs-custom">
                        <li class="pull-left header"><i class="fa fa-info-circle"></i> Pemesanan yang Mendekati Tanggal Pengiriman</li>
                        <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                      </ul>
                    </div>
                    <div class="box-body table-responsive">
                      <table id="example1" class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Kode Pemesanan</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($pemesanan as $q=>$v)
                          <tr>
                            <td>{{$q+1}}</td>
                            <td>{{ $v->kode_pemesanan }}</td>
                            <td>{{ $v->tanggal }}</td>
                            <td>
                              <a href="{{ url('produksi/pemesanan/lihat/'.$v->id.'/pemesananproduksi') }}" class="btn btn-sm btn-default"><i class="fa fa-eye"></i> Lihat Detail</a>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
            </section>
          </div>
        </div>
      <!-- informasi pemesanan -->

    </section>
    <!-- /. main content -->
  </div>
@endsection