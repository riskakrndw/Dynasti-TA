@extends('layout_master.master')

@section("title", "Produksi")

@section("produksi", "active")

@section("moreasset")
<link href="{{url('dist/css/bootstrap-modal-bs3patch.css')}}" rel="stylesheet" />
<link href="{{url('dist/css/bootstrap-modal.css')}}" rel="stylesheet" />

@endsection

@section("content")
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Data Produksi
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Produksi</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <!-- Tambah produksi -->
          <div class="col-md-12">
            <a href="{{route('tambahProduksi')}}"><button type="button" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Produksi </button></a>
          </div>
        <!-- /Tambah produksi -->        

        <!-- Data produksi -->
        <div class="col-xs-12">
          <br>
          <div class="box">
            <!-- header -->
              <div class="box-header">
                <ul class="nav nav-tabs-custom">
                  <li class="pull-left box-header"><h3 class="box-title">Daftar Produksi</h3></li>
                </ul>
              </div>
            <!-- /header -->

            <!-- tabel produksi -->
              <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th style="width: 10px">No</th>
                      <th style="width: 125px">Kode Produksi</th>
                      <th style="width: 150px">Tanggal</th>
                      <th style="width: 350px">Nama Ice Cream</th>
                      <th style="width: 100px">Jumlah</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; ?>
                    @foreach($data as $data)
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $data->kode_produksi }}</td>
                      <td>{{ $data->tgl }}</td>
                      <td>{{ $data->ice_cream->nama }}</td>
                      <td>{{ $data->jumlah }}</td>
                      <td>
                        <a href="{{ url('manager/produksi/edit/'.$data->id) }}" class="btn btn-sm btn-default"><i class="fa fa-edit"></i> Ubah</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            <!-- /.tabel produksi -->

          </div>
        </div>
        <!-- /Data produksi -->



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