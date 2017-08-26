@extends('layout_master.master')

@section("title", "Detail Data Rasa")

@section("rasa", "active")

@section("master", "active")

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
      <ol class="breadcrumb">
        <li><a href="{{route('beranda')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a> Master Data</a></li>
        <li><a href="{{route('rasa')}}">Data Rasa</a></li>
        <li class="active">Lihat Detail</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        
        <div class="col-md-12">
          <a href="{{route('rasa')}}"><button type="button" class="btn btn-sm btn-primary"><i class="fa  fa-angle-double-left "></i> Kembali ke halaman data rasa </button></a>
        </div>   

        <!-- Tambah Es -->
          <div class="col-md-12">
            <br>
            <div class="box">
              <ul class="nav nav-tabs-custom">
                <li class="pull-left box-header"><h3 class="box-title">Data Rasa</h3></li>
              </ul>

              <!-- Form tambah es -->
                <form role="form" action="" method="">
                  {{csrf_field()}}
                  <div class="box-body">
                    <div class="col-md-12">
                      <label>Nama</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        <input class="form-control" placeholder="Nama" name="nama" id="nama" value="{{ $data->nama }}" disabled>
                      </div>
                      @if($errors->has('nama'))
                        <span class="help-block">{{$errors->first('nama')}}</span>
                      @endif
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <br>
                        <label>Tersedia dalam jenis : </label><br>
                        <?php
                          $no = 1;
                        ?>
                        @foreach($data->ice_cream_notrashed as $dataJenis)
                        <label>{{$no++}} . {{ $dataJenis->jenis->nama }}</label>
                        <br>
                        dalam 1 kali pembuatan menghasilkan:
                        <input class="form-control" disabled placeholder="{{ $dataJenis->jumlah_produksi }}">
                        <br>
                        @endforeach
                      </div>
                    </div>
                  </div>
                
              <!-- /Form tambah es -->

              <hr id="garis">
              <ul class="nav nav-tabs-custom">
                <li class="pull-left box-header"><h3 class="box-title">Bahan baku yang diperlukan</h3></li>
              </ul>

              <!-- tabel bahan -->
                <div class="box-body table-responsive">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width:50px">No</th>
                        <th style="width: 325px">Nama Bahan</th>
                        <th style="width: 175px">Jumlah</th>
                        <th style="width: 200px">Satuan</th>
                      </tr>
                    </thead>
                    <tbody id="type_container">
                      <?php $no=1; ?>
                      @foreach($data->detail_rasa as $detailRasa)
                        <?php $id = $no+1; ?>
                        <tr id="tr{{$id}}">
                          <td>{{ $no++ }}</td>
                          <td>{{ $detailRasa->bahan->nama }}</td>
                          <td>{{ $detailRasa->takaran }}</td>
                          <td>{{ $detailRasa->bahan->satuan }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <br>


                </div>
              <!-- /.tabel bahan -->
            </div>
          </div>
          </form>
        <!-- /Tambah es -->
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

@endsection