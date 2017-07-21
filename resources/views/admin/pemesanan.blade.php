@extends('layout_master.master')

@section("title", "Data Pemesanan")

@section("pesanan", "active")

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
        <li class="active">Data Pemesanan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <!-- Tambah es -->
          <div class="col-md-12">
            <a href="{{route('tambahPemesanan')}}"><button type="button" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Pengadaan </button></a>
          </div>

        <!-- /Tambah es -->        
        <div class="col-md-12">
          <br>
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#semua" data-toggle="tab">Semua</a></li>
              <li><a href="#menunggu" data-toggle="tab">Menunggu</a></li>
              <li><a href="#siap" data-toggle="tab">Siap</a></li>
              <li><a href="#selesai" data-toggle="tab">Selesai</a></li>
              <li><a href="#batal" data-toggle="tab">Batal</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="semua">
                <div class="box-body table-responsive">
                  <table id="example21" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width: 10px">No</th>
                        <th style="width: 100px">Kode Pemesanan</th>
                        <th style="width: 100px">Tanggal</th>
                        <th style="width: 100px">Nama</th>
                        <th style="width: 150px">Alamat</th>
                        <th style="width: 100px">Total</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                      <?php $no=1; ?>
                      @foreach($data as $data)
                        <tr>
                          <td>{{ $no++ }}</td>
                          <td>{{ $data->kode_pemesanan }}</td>
                          <td>{{ $data->tanggal }}</td>
                          <td>{{ $data->nama }}</td>
                          <td>{{ $data->alamat }}</td>
                          <td>{{ $data->total }}</td>
                          <td>
                           <a href="" class="btn btn-sm btn-default btnLihatBahan"><i class="fa fa-eye"></i> Lihat Detail</a>
                           <a href="" class="btn btn-sm btn-default btnEditEs"><i class="fa fa-edit"></i> Ubah</a>
                         </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>

              <!-- /.tab-pane -->
              <div class="tab-pane" id="menunggu">
                <div class="box-body table-responsive">
                  <table id="example22" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width: 10px">No</th>
                        <th style="width: 100px">Kode Pemesanan</th>
                        <th style="width: 100px">Tanggal</th>
                        <th style="width: 100px">Nama</th>
                        <th style="width: 150px">Alamat</th>
                        <th style="width: 100px">Total</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                      <?php $no=1; ?>
                      @foreach($datamenunggu as $data)
                        <tr>
                          <td>{{ $no++ }}</td>
                          <td>{{ $data->kode_pemesanan }}</td>
                          <td>{{ $data->tanggal }}</td>
                          <td>{{ $data->nama }}</td>
                          <td>{{ $data->alamat }}</td>
                          <td>{{ $data->total }}</td>
                          <td>
                           <a href="" class="btn btn-sm btn-default btnLihatBahan"><i class="fa fa-eye"></i> Lihat Detail</a>
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
                        <th style="width: 150px">Alamat</th>
                        <th style="width: 100px">Total</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                      <?php $no=1; ?>
                      @foreach($datasiap as $data)
                        <tr>
                          <td>{{ $no++ }}</td>
                          <td>{{ $data->kode_pemesanan }}</td>
                          <td>{{ $data->tanggal }}</td>
                          <td>{{ $data->nama }}</td>
                          <td>{{ $data->alamat }}</td>
                          <td>{{ $data->total }}</td>
                          <td>
                           <a href="" class="btn btn-sm btn-default btnLihatBahan"><i class="fa fa-eye"></i> Lihat Detail</a>
                         </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="selesai">
                <div class="box-body table-responsive">
                  <table id="example24" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width: 10px">No</th>
                        <th style="width: 100px">Kode Pemesanan</th>
                        <th style="width: 100px">Tanggal</th>
                        <th style="width: 100px">Nama</th>
                        <th style="width: 150px">Alamat</th>
                        <th style="width: 100px">Total</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                      <?php $no=1; ?>
                      @foreach($dataselesai as $data)
                        <tr>
                          <td>{{ $no++ }}</td>
                          <td>{{ $data->kode_pemesanan }}</td>
                          <td>{{ $data->tanggal }}</td>
                          <td>{{ $data->nama }}</td>
                          <td>{{ $data->alamat }}</td>
                          <td>{{ $data->total }}</td>
                          <td>
                           <a href="" class="btn btn-sm btn-default btnLihatBahan"><i class="fa fa-eye"></i> Lihat Detail</a>
                         </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="tab-pane" id="gagal">
                <div class="box-body table-responsive">
                  <table id="example25" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width: 10px">No</th>
                        <th style="width: 200px">Kode Pemesanan</th>
                        <th style="width: 200px">Tanggal</th>
                        <th style="width: 200px">Total</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        <tr>
                        <th style="width: 10px">No</th>
                        <th style="width: 100px">Kode Pemesanan</th>
                        <th style="width: 100px">Tanggal</th>
                        <th style="width: 100px">Nama</th>
                        <th style="width: 150px">Alamat</th>
                        <th style="width: 100px">Total</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                      <?php $no=1; ?>
                      @foreach($databatal as $data)
                        <tr>
                          <td>{{ $no++ }}</td>
                          <td>{{ $data->kode_pemesanan }}</td>
                          <td>{{ $data->tanggal }}</td>
                          <td>{{ $data->nama }}</td>
                          <td>{{ $data->alamat }}</td>
                          <td>{{ $data->total }}</td>
                          <td>
                           <a href="" class="btn btn-sm btn-default btnLihatBahan"><i class="fa fa-eye"></i> Lihat Detail</a>
                         </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>

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