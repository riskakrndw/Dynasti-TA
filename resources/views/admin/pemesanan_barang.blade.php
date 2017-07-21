@extends('layout_master.master')

@section("title", "Data Produk Pesanan")

@section("produkpesanan", "active")

@section("pemesanan", "active")

@section("moreasset")
<link href="{{url('dist/css/bootstrap-modal-bs3patch.css')}}" rel="stylesheet" />
<link href="{{url('dist/css/bootstrap-modal.css')}}" rel="stylesheet" />

@endsection

@section("content")
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Data Produk Pesanan
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> Transaksi</a></li>
        <li class="active">Data Produk Pesanan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <!-- Tambah es -->
          <!-- <div class="col-md-12">
            <a href="{{route('tambahPemesanan')}}"><button type="button" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Pengadaan </button></a>
          </div> -->

        <!-- /Tambah es -->        
        <div class="col-md-12">
          <br>
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#semua" data-toggle="tab">Semua</a></li>
              <li><a href="#menunggu" data-toggle="tab">Menunggu</a></li>
              <li><a href="#siap" data-toggle="tab">Siap</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="semua">
                <div class="box-body table-responsive">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width: 10px">No</th>
                        <th style="width: 100px">Kode Pemesanan</th>
                        <th style="width: 100px">Tanggal</th>
                        <th style="width: 100px">Nama Ice Cream</th>
                        <th style="width: 100px">Jumlah</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                      <?php $no=1; ?>
                      @foreach($data as $data)
                        <tr>
                          <td>{{ $no++ }}</td>
                          <td>{{ $data->pemesanan->kode_pemesanan }}</td>
                          <td>{{ $data->pemesanan->tanggal }}</td>
                          <td>{{ $data->ice_cream->nama }}</td>
                          <td>{{ $data->jumlah }}</td>
                          <td>
                           <a href="" class="btn btn-sm btn-default btnLihatBahan"><i class="fa fa-eye"></i> Lihat Detail</a>
                           <a href="{{ url('manager/pembelian/edit/'.$data->id) }}" class="btn btn-sm btn-default btnEditEs"><i class="fa fa-edit"></i> Ubah</a>
                         </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="tab-pane" id="menunggu">
                <div class="box-body table-responsive">
                  <table id="example22" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width: 10px">No</th>
                        <th style="width: 100px">Kode Pemesanan</th>
                        <th style="width: 100px">Tanggal</th>
                        <th style="width: 100px">Nama Ice Cream</th>
                        <th style="width: 100px">Jumlah</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                      <?php $no=1; ?>
                      @foreach($datamenunggu as $data)
                        <tr>
                          <td>{{ $no++ }}</td>
                          <td>{{ $data->pemesanan->kode_pemesanan }}</td>
                          <td>{{ $data->pemesanan->tanggal }}</td>
                          <td>{{ $data->ice_cream->nama }}</td>
                          <td>{{ $data->jumlah }}</td>
                          <td>
                           <a href="" class="btn btn-sm btn-default btnLihatBahan"><i class="fa fa-eye"></i> Lihat Detail</a>
                           <a href="{{ url('manager/pembelian/edit/'.$data->id) }}" class="btn btn-sm btn-default btnEditEs"><i class="fa fa-edit"></i> Siap</a>
                         </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="siap">
                <div class="box-body table-responsive">
                  <table id="example23" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width: 10px">No</th>
                        <th style="width: 100px">Kode Pemesanan</th>
                        <th style="width: 100px">Tanggal</th>
                        <th style="width: 100px">Nama</th>
                        <th style="width: 100px">Jumlah</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                      <?php $no=1; ?>
                      @foreach($datasiap as $data)
                        <tr>
                          <td>{{ $no++ }}</td>
                          <td>{{ $data->pemesanan->kode_pemesanan }}</td>
                          <td>{{ $data->pemesanan->tanggal }}</td>
                          <td>{{ $data->ice_cream->nama }}</td>
                          <td>{{ $data->jumlah }}</td>
                          <td>
                           <a href="" class="btn btn-sm btn-default btnLihatBahan"><i class="fa fa-eye"></i> Lihat Detail</a>
                           <a href="{{ url('manager/pembelian/edit/'.$data->id) }}" class="btn btn-sm btn-default btnEditEs"><i class="fa fa-edit"></i> Ubah</a>
                         </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.tab-pane -->

            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>

      </div>
    </section>
    <!-- /. main content -->
  </div>
@endsection

@section("morescript")

  <!-- Modal Windows -->
 <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script> -->
  <script src="{{url('dist/js/bootstrap-modalmanager.js')}}"></script>
  <script src="{{url('dist/js/bootstrap-modal.js')}}"></script>
  <script src="{{url('dist/js/validasinumeric.js')}}"></script>

@endsection