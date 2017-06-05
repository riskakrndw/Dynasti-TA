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
          <p>Selamat Datang di Sistem Pengelolaan Toko.</p>
        </div>
      <!-- /Alert Success -->

      <!-- Info beranda -->
        <div class="row">
          <!-- Item terjual -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-red">
                <span class="info-box-icon"><i class="fa fa-cutlery"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Ice Cream</span>
                  <span class="info-box-number">41,410</span>
                </div>
              </div>
            </div>
          <!-- /Item terjual -->

          <!-- Untung bulan ini --> 
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-red">
                <span class="info-box-icon"><i class="fa fa-calendar"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Pemesanan</span>
                  <span class="info-box-number">41,410</span>
                </div>
              </div>
            </div>
          <!-- /Untung bulan ini -->

          <!-- Jumlah Pelanggan -->  
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-red">
                <span class="info-box-icon"><i class="fa fa-cart-plus"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Penjualan</span>
                  <span class="info-box-number">41,410</span>
                </div>
              </div>
            </div>
          <!-- /Jumlah Pelanggan -->

          <!-- Jumlah Pemasok -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-red">
                <span class="info-box-icon"><i class="fa fa-cart-arrow-down"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Pembelian</span>
                  <span class="info-box-number">41,410</span>
                </div>
              </div>
            </div>
          <!-- /Jumlah Pemasok -->
        </div>
      <!-- /Info beranda -->

      <!-- Stok di bawah minimal -->
        <div class="row">
          <div class="col-xs-12">
            <div class="box box-success">
              <div class="box-header">
                  <ul class="nav nav-tabs-custom">
                    <li class="pull-left box-header"><i class="fa fa-info-circle"></i>
                  <h3 class="box-title">Stok Barang yang telah mencapai batas minimum</h3></li>
                    <div class="box-tools">
                      <div class="input-group input-group-sm pull-right" style="width: 300px;">
                        <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                        <div class="input-group-btn">
                          <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                      </div>
                    </div>
                  </ul>
                </div>


              <!-- tabel stok sisa -->
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width: 20px">No</th>
                        <th style="width: 200px">ID Barang</th>
                        <th style="width: 700px">Nama Barang</th>
                        <th>Stok</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>Internet
                          Explorer 4.0
                        </td>
                        <td>Win 95+</td>
                        <td> 4</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Firefox 1.5</td>
                        <td>Win 98+ / OSX.2+</td>
                        <td>1.8</td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>Firefox 2.0</td>
                        <td>Win 98+ / OSX.2+</td>
                        <td>1.8</td>
                      </tr>
                      <tr>
                        <td>4</td>
                        <td>Firefox 3.0</td>
                        <td>Win 2k+ / OSX.3+</td>
                        <td>1.9</td>
                      </tr>
                      <tr>
                        <td>5</td>
                        <td>Camino 1.0</td>
                        <td>OSX.2+</td>
                        <td>1.8</td>
                      </tr>
                      <tr>
                        <td>6</td>
                        <td>Camino 1.5</td>
                        <td>OSX.3+</td>
                        <td>1.8</td>
                      </tr>
                      <tr>
                        <td>7</td>
                        <td>Netscape 7.2</td>
                        <td>Win 95+ / Mac OS 8.6-9.2</td>
                        <td>1.7</td>
                      </tr>
                      <tr>
                        <td>8</td>
                        <td>Netscape Browser 8</td>
                        <td>Win 98SE+</td>
                        <td>1.7</td>
                      </tr>
                      <tr>
                        <td>9</td>
                        <td>Netscape Navigator 9</td>
                        <td>Win 98+ / OSX.2+</td>
                        <td>1.8</td>
                      </tr>
                      <tr>
                        <td>10</td>
                        <td>Mozilla 1.0</td>
                        <td>Win 95+ / OSX.1+</td>
                        <td>1</td>
                      </tr>
                      <tr>
                        <td>11</td>
                        <td>Mozilla 1.1</td>
                        <td>Win 95+ / OSX.1+</td>
                        <td>1.1</td>
                      </tr>
                      <tr>
                        <td>12</td>
                        <td>Mozilla 1.2</td>
                        <td>Win 95+ / OSX.1+</td>
                        <td>1.2</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              <!-- /.tabel stok sisa -->
            </div>
          </div>
        </div>
      <!-- /Stok di bawah minimal -->
      
    </section>
    <!-- /. main content -->
  </div>
@endsection