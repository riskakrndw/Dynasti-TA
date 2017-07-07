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

          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3>150</h3>

                <p>Total Pembelian</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-cart"></i>
              </div>
              <a href="#" class="small-box-footer">Info Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-6 col-xs-12">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3>5</h3>

                <p>Permintaan Pengadaan</p>
              </div>
              <div class="icon">
                <i class="ion ion-plus-round"></i>
              </div>
              <a href="{{route('konfirmasi')}}" class="small-box-footer">Info Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h3>65</h3>

                <p>Total Penjualan</p>
              </div>
              <div class="icon">
                <i class="ion ion-pricetags"></i>
              </div>
              <a href="#" class="small-box-footer">Info Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
      <!-- /Info beranda -->

      <!-- info -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">
            <!-- tabel stok sisa -->
              <div class="box box-success">
                <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs pull-right">
                    <li class="pull-left header"><i class="fa fa-info-circle"></i> Informasi Pemesanan</li>
                  </ul>
                  <div class="tab-content">
                    <table id="example1" class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th style="width: 10px">No</th>
                          <th style="width: 150px">Nama</th>
                          <th style="width: 100px">Tanggal</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>PEM0001</td>
                          <td>Riska Kurnia Dewi</td>
                          <td>27-09-2017</td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>PEM0002</td>
                          <td>Riska Kurnia Dewi</td>
                          <td>27-09-2017</td>
                        </tr>
                        <tr>
                          <td>1</td>
                          <td>PEM0001</td>
                          <td>Riska Kurnia Dewi</td>
                          <td>27-09-2017</td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>PEM0002</td>
                          <td>Riska Kurnia Dewi</td>
                          <td>27-09-2017</td>
                        </tr>
                        <tr>
                          <td>1</td>
                          <td>PEM0001</td>
                          <td>Riska Kurnia Dewi</td>
                          <td>27-09-2017</td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>PEM0002</td>
                          <td>Riska Kurnia Dewi</td>
                          <td>27-09-2017</td>
                        </tr>
                        <tr>
                          <td>1</td>
                          <td>PEM0001</td>
                          <td>Riska Kurnia Dewi</td>
                          <td>27-09-2017</td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>PEM0002</td>
                          <td>Riska Kurnia Dewi</td>
                          <td>27-09-2017</td>
                        </tr>
                        <tr>
                          <td>1</td>
                          <td>PEM0001</td>
                          <td>Riska Kurnia Dewi</td>
                          <td>27-09-2017</td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>PEM0002</td>
                          <td>Riska Kurnia Dewi</td>
                          <td>27-09-2017</td>
                        </tr>
                        <tr>
                          <td>1</td>
                          <td>PEM0001</td>
                          <td>Riska Kurnia Dewi</td>
                          <td>27-09-2017</td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>PEM0002</td>
                          <td>Riska Kurnia Dewi</td>
                          <td>27-09-2017</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  </div>
                  <!-- /.tab-content -->
                </div>
            <!-- /.tabel es -->
    
            <!-- /.tabel stok sisa -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">
            <div class="box box-success">
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs pull-right">
                <li class="active"><a href="#tab_1-1" data-toggle="tab">Ice Cream</a></li>
                <li><a href="#tab_2-2" data-toggle="tab">Bahan Baku</a></li>
                <li class="pull-left header"><i class="fa fa-info-circle"></i> Informasi Stok</li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1-1">
                  <div class="tab-content">
                    <table id="example1" class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th style="width: 10px">No</th>
                          <th style="width: 150px">Nama</th>
                          <th style="width: 100px">Stok</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>Riska Kurnia Dewi</td>
                          <td>27-09-2017</td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Riska Kurnia Dewi</td>
                          <td>27-09-2017</td>
                        </tr>
                        <tr>
                          <td>1</td>
                          <td>Riska Kurnia Dewi</td>
                          <td>27-09-2017</td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Riska Kurnia Dewi</td>
                          <td>27-09-2017</td>
                        </tr>
                        <tr>
                          <td>1</td>
                          <td>Riska Kurnia Dewi</td>
                          <td>27-09-2017</td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Riska Kurnia Dewi</td>
                          <td>27-09-2017</td>
                        </tr>
                        <tr>
                          <td>1</td>
                          <td>Riska Kurnia Dewi</td>
                          <td>27-09-2017</td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Riska Kurnia Dewi</td>
                          <td>27-09-2017</td>
                        </tr>
                        <tr>
                          <td>1</td>
                          <td>Riska Kurnia Dewi</td>
                          <td>27-09-2017</td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Riska Kurnia Dewi</td>
                          <td>27-09-2017</td>
                        </tr>
                        <tr>
                          <td>1</td>
                          <td>Riska Kurnia Dewi</td>
                          <td>27-09-2017</td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Riska Kurnia Dewi</td>
                          <td>27-09-2017</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2-2">
                  
                </div>
              </div>
              </div>
              <!-- /.tab-content -->
            </div>
          </section>
          <!-- right col -->
        </div>
      <!-- / info -->
      
    </section>
    <!-- /. main content -->
  </div>
@endsection