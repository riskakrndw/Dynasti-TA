@extends('layout_master.master')

@section("title", "Manager | Laporan Penjualan")

@section("lapstokes", "active")

@section("laporan", "active")

@section("moreasset")
<link href="{{url('dist/css/bootstrap-modal-bs3patch.css')}}" rel="stylesheet" />
<link href="{{url('dist/css/bootstrap-modal.css')}}" rel="stylesheet" />
<link href="{{url('dist/js/select2/select2.css')}}" rel="stylesheet" type="text/css" />
<link href="{{url('dist/js/select2/select2-bootstrap-dick.css')}}" rel="stylesheet" type="text/css" />

<style type="text/css">
  #garis{
    border: 2px solid #dbdbdb;
  }
</style>
@endsection

@section("content")
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Stok Ice Cream
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> Beranda</a></li>
        <li class="active">Stok Ice Cream</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <a href="" id="cetak"><button type="button" class="btn .btn-lg btn-primary"><i class="fa  fa-print "></i> Cetak </button></a>
        </div>

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
                      <th style="width: 10px">No</th>
                      <th style="width: 300px">Nama Ice Cream</th>
                      <th style="width: 100px">Harga</th>
                      <th style="width: 100px">Stok</th>
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
<!-- validasi keyboard numeric only -->
  <script src="{{url('dist/js/validasinumeric.js')}}"></script>
<!-- dinamically add -->
  <script src="{{url('dist/js/jquery-1.8.2.min.js')}}" type="text/javascript" charset="utf8"></script>
  <script src="{{url('dist/js/select2/select2.js')}}"></script>
<!-- date -->
  <script src="{{url('dist/js/bootstrap-datepicker.js')}}"></script>

  <script>
    $("#cetak").attr("href", "{{url('manager/laporan/printice')}}").attr('target','_blank');;
  </script>

@endsection