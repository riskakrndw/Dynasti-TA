@extends('layout_master.master')

@section("title", "Manager | Laporan Pemesanan")

@section("lappesan", "active")

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
        Laporan Pemesanan
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> Laporan</a></li>
        <li class="active">Laporan Pemesanan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <ul class="nav nav-tabs-custom">
                <li class="pull-left box-header"><h3 class="box-title">Laporan Pemesanan</h3></li>
              </ul>
            </div>
            <input type="hidden" value="{{csrf_token()}}" id="token" name="_token">
            <div class="box-body">
              <div class="col-xs-12">
                <label>Dari Tanggal</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="tgl_a" class="form-control pull-right" id="datepicker">
                </div>
              </div>
              <div class="col-xs-12">
                <br>
                <label>Sampai Tanggal</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="tgl_b" class="form-control pull-right" id="datepicker1">
                </div>
              </div>
              <div class="col-xs-12">
                <br>
                <button id="cari" class="btn btn-primary btnCetak"><i class="fa  fa-search "></i> Cari</button>
                <a href="#" id="cetak" class="btn btn-primary btnCetak"><i class="fa  fa-print "></i> Cetak</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <br>
          <div class="box">
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th style="width: 30px">No</th>
                    <th style="width: 210px">Kode Pemesanan</th>
                    <th style="width: 168px">Tanggal</th>
                    <th style="width: 168px">Total</th>
                  </tr>
                </thead>
                <tbody id="pemesanan">
                  @foreach($data as $q=>$v)
                    <tr>
                      <td>{{ $q+1 }}</td>
                      <td>{{ $v->kode_pemesanan}}</td>
                      <td>{{ $v->tanggal }}</td>
                      <td>{{ $v->total }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
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

  <script>
    $(document).ready(function(){
      $("#cari").click(function(){
        var nomorBaris = 0;
        var tgl_a=$("#datepicker").val();
        var tgl_b=$("#datepicker1").val();
        var token=$("#token").val();

        var link="{{url('lappemesanan')}}";
        $.ajax({
          type:"post",
          url:link,
          data:{"tgl_a":tgl_a,"tgl_b":tgl_b,"_token":token},
          success:function(data){
            $("#pemesanan").empty();
            $.each(data, function(k, v) {
              nomorBaris = nomorBaris + 1;
              $("#pemesanan").append("<tr><td align='center'>"+nomorBaris+"</td><td>"+v.kode_pemesanan+"</td><td>"+v.tanggal+"</td><td>"+v.total+"</td></tr>");
            });

            $("#cetak").attr("href", "{{url('manager/laporan/printpemesanan')}}/"+tgl_a+'/'+tgl_b).attr('target','_blank');;
          }
        })
      })
    })
  </script>
@endsection