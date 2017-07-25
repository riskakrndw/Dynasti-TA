@extends('layout_master.master')

@section("title", "Admin | Beranda")

@section("beranda", "active")

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
          <p>Selamat Datang di Halaman Manager</p>
        </div>
      <!-- /Alert Success -->

      <!-- Info beranda -->
        <div class="row">

          <div class="col-lg-3">
            <div class="small-box bg-red">
              <div class="inner">
                <h3>{{ $totalstokbahan }}</h3>

                <p>Stok Bahan Baku</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-cart"></i>
              </div>
              <a href="{{route('stokBahan')}}" class="small-box-footer">Info Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="small-box bg-green">
              <div class="inner">
                <h3>{{ $jumlahpermintaan }}</h3>

                <p>Permintaan Pengadaan</p>
              </div>
              <div class="icon">
                <i class="ion ion-plus-round"></i>
              </div>
              <a href="{{route('konfirmasi')}}" class="small-box-footer">Info Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="small-box bg-red">
              <div class="inner">
                <h3>{{ $totalstokes }}</h3>

                <p>Stok Ice Cream</p>
              </div>
              <div class="icon">
                <i class="ion ion-pricetags"></i>
              </div>
              <a href="{{route('stokIce')}}" class="small-box-footer">Info Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
      <!-- /Info beranda -->

      <!-- info -->
        <div class="row">
          <!-- Left col -->
          <div class="col-lg-8">
            <section class="connectedSortable">
              <!-- info pemesanan -->
                <div class="box">
                  <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs pull-right">
                      <li class="pull-left header"><i class="fa fa-info-circle"></i> Informasi Pemesanan</li>
                    </ul>
                    <div class="tab-content">
                      <table id="example1" class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th style="width: 10px">No</th>
                            <th style="width: 200px">Nama</th>
                            <th style="width: 200px">Tanggal</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                              <a href="" class="btn btn-sm btn-default btnLihatBahan"><i class="fa fa-eye"></i> Lihat Detail</a>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              <!-- /.info pemesanan -->
            </section>
          </div>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->


          <!-- <div class="col-lg-4">
            <section class="connectedSortable">
                <div class="box">
                  <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs pull-right">
                      <li class="pull-left header"><i class="fa fa-info-circle"></i> Ice Cream Terlaku</li>
                    </ul>
                    <div class="tab-content">
                      <table id="example1" class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th style="width: 100px">No</th>
                            <th style="width: 500px">Nama</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>Ice Cream Vanilla</td>
                          </tr>
                        </tbody>
                      </table>
                      <a href="#" class="small-box-footer">Info Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                </div>
            </section>
          </div> -->

        </div>
      <!-- / info -->
      
    </section>
    <!-- /. main content -->
  </div>
@endsection