@extends('layout_master.master')

@section("title", "Bagian Pengadaan | Ice Cream")

@section("stokes", "active")

@section("stok", "active")

@section("moreasset")
<link href="{{url('dist/css/bootstrap-modal-bs3patch.css')}}" rel="stylesheet" />
<link href="{{url('dist/css/bootstrap-modal.css')}}" rel="stylesheet" />

@endsection

@section("content")
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Data Stok Ice Cream
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> Data Stok</a></li>
        <li class="active">Ice Cream</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">      

        <!-- Data es -->
        <div class="col-xs-12">
          <br>
          <div class="box">
            <!-- header -->
              <div class="box-header">
                <ul class="nav nav-tabs-custom">
                  <li class="pull-left box-header"><h3 class="box-title">Daftar Ice Cream</h3></li>
                </ul>
              </div>
            <!-- /header -->

            <!-- tabel es -->
              <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Ice Cream</th>
                      <th>Harga</th>
                      <th>Stok</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; ?>
                    @foreach($data as $data)
                      @if($data->stok < $data->stok_min)
                        <tr style="background-color:#e74c3c;">
                          <td>{{ $no++ }}</td>
                          <td>{{ $data->nama }}</td>
                          <td>Rp {{ number_format($data->jenis->harga,2,",","." ) }}</td>
                          <td>{{ $data->stok }}</td>
                        </tr>
                      @else
                        <tr>
                          <td>{{ $no++ }}</td>
                          <td>{{ $data->nama }}</td>
                          <td>Rp {{ number_format($data->jenis->harga,2,",","." ) }}</td>
                          <td>{{ $data->stok }}</td>
                        </tr>
                      @endif
                    @endforeach
                  </tbody>
                </table>
              </div>
            <!-- /.tabel es -->

          </div>
        </div>
        <!-- /Data es -->



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