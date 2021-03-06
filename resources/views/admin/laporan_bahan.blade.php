@extends('layout_master.master')

@section("title", "Manager | Laporan Penjualan")

@section("lapstokbahan", "active")

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
        Stok Bahan Baku
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> Beranda</a></li>
        <li class="active">Stok Bahan Baku</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <a href="#" id="cetak" class="btn .btn-lg btn-primary"><i class="fa  fa-print "></i> Cetak</a>
        </div>

        <!-- Data es -->
        <div class="col-xs-12">
          <br>
          <div class="box">
            <!-- header -->
              <div class="box-header">
                <ul class="nav nav-tabs-custom">
                  <li class="pull-left box-header"><h3 class="box-title">Daftar Bahan Baku</h3></li>
                </ul>
              </div>
            <!-- /header -->

            <!-- tabel es -->
              <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th style="width: 30px">No</th>
                      <th style="width: 300px">Nama Bahan</th>
                      <th style="width: 300px">Satuan</th>
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
                          <td>{{ $data->satuan }}</td>
                          <td>{{ $data->stok }}</td>
                        </tr>
                      @else
                        <tr>
                          <td>{{ $no++ }}</td>
                          <td>{{ $data->nama }}</td>
                          <td>{{ $data->satuan }}</td>
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
<!-- date -->
  <script src="{{url('dist/js/bootstrap-datepicker.js')}}"></script>

  <script>

  $("#example1").DataTable({
    'info':false
  });

    $("#cetak").attr("href", "{{url('manager/laporan/printbahan')}}").attr('target','_blank');;
  </script>

@endsection