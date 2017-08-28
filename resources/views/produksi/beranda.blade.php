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
          <p>Selamat Datang di Halaman Bagian Produksi</p>
        </div>
      <!-- /Alert Success -->

      <!-- Info beranda -->
        <div class="row">

        </div>
      <!-- /Info beranda -->

    </section>
    <!-- /. main content -->
  </div>
@endsection