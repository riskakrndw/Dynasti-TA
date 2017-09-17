@extends('layout_master.master')

@section("title", "Bagian Pengadaan | Bahan Baku")

@section("stokbahan", "active")

@section("stok", "active")

@section("moreasset")
<link href="{{url('dist/css/bootstrap-modal-bs3patch.css')}}" rel="stylesheet" />
<link href="{{url('dist/css/bootstrap-modal.css')}}" rel="stylesheet" />

@endsection

@section("content")
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Data Stok Bahan Baku
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> Data Stok</a></li>
        <li class="active">Bahan Baku</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">       

        <!-- Data bahan -->
        <div class="col-xs-12">
          <div class="box">

            <!-- header -->
              <div class="box-header">
                <ul class="nav nav-tabs-custom">
                  <li class="pull-left box-header"><h3 class="box-title">Daftar Bahan</h3></li>
                </ul>
              </div>
            <!-- /header -->

            <!-- tabel bahan -->
              <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th style="width: 30px">No</th>
                      <th style="width: 250px">Nama Bahan</th>
                      <th style="width: 110px">Satuan</th>
                      <th style="width: 180px">Harga Satuan</th>
                      <th style="width: 100px">Stok</th>
                      <th style="width: 100px">Stok Minimal</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; ?>
                    @foreach($data as $data)
                      @if($data->stok < $data->stok_min)
                          <tr style="background-color:#e74c3c;">
                            <td>{{ $no++ }}</td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->satuan }}</td>
                            <td>{{ $data->harga }}</td>
                            <td>{{ $data->stok }}</td>
                            <td>{{ $data->stok_min }}</td>
                          </tr>
                      @else
                        <tr>
                          <td>{{ $no++ }}</td>
                          <td>{{ $data->nama }}</td>
                          <td>{{ $data->satuan }}</td>
                          <td>{{ $data->harga }}</td>
                          <td>{{ $data->stok }}</td>
                          <td>{{ $data->stok_min }}</td>
                        </tr>
                      @endif
                    @endforeach
                  </tbody>
                </table>
              </div>
            <!-- /.tabel bahan -->

          </div>
        </div>
        <!-- /Data bahan -->

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