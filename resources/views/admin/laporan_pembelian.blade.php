@extends('layout_master.master')

@section("title", "Laporan Pengadaan")

@section("lapbeli", "active")

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
        Laporan Pengadaan
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> Laporan</a></li>
        <li class="active">Laporan Pengadaan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <!-- Data jenis -->
          <div class="col-xs-12">
            <div class="box">

              <!-- header -->
                <div class="box-header">
                  <ul class="nav nav-tabs-custom">
                    <li class="pull-left box-header"><h3 class="box-title">Laporan Pengadaan</h3></li>
                  </ul>
                </div>
              <!-- /header -->

              <div class="box-body">
                <div class="col-xs-12">
                  <label>Dari Tanggal</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="datepicker">
                  </div>
                </div>
                <div class="col-xs-12">
                <br>
                  <label>Sampai Tanggal</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="datepicker1">
                  </div>
                </div>
                <div class="col-xs-12">
                <br>
                  <button type="submit" class="btn btn-primary btnCetak">Cari</button>
                  <button type="submit" class="btn btn-primary btnCetak">Cetak</button>
                </div>
              </div>

            </div>
          </div>
        <!-- /Data jenis -->

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
    //Date picker
      $('#datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd"
      });

      $('#datepicker1').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd"
      });
  </script>


@endsection