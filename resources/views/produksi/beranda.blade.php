@extends('layout_master.master')

@section("title", "Bagian Pengadaan | Beranda")

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
          <p>Selamat Datang di Halaman Bagian Pengadaan</p>
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
              <a href="#" class="small-box-footer">Info Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
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

    </section>
    <!-- /. main content -->
  </div>
@endsection