@extends('layout_master.master')

@section("title", "Tambah Ice Cream")

@section("es", "active")

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
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> Data Master</a></li>
        <li><a href="#">Ice Cream</a></li>
        <li class="active">Lihat Detail</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        
        <div class="col-md-12">
          <a href="{{route('icecream')}}"><button type="button" class="btn btn-sm btn-primary"><i class="fa  fa-angle-double-left "></i> Kembali ke halaman data ice cream </button></a>
        </div>   

        <!-- Tambah Es -->
          <div class="col-md-12">
            <br>
            <div class="box box-success">
              <ul class="nav nav-tabs-custom">
                <li class="pull-left box-header"><h3 class="box-title">Data Ice Cream</h3></li>
              </ul>

              <!-- Form tambah es -->
                <form role="form" action="" method="">
                  {{csrf_field()}}
                  <div class="box-body">
                    <div class="col-md-12">
                      <label>Nama Ice Cream</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        <input class="form-control" placeholder="Nama Ice Cream" name="nama" id="nama" value="{{ $data->nama }}" disabled>
                      </div>
                      @if($errors->has('nama'))
                        <span class="help-block">{{$errors->first('nama')}}</span>
                      @endif
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <br>
                        <label>Nama Rasa</label>
                        <input class="form-control" disabled
                          @if($data->id_rasa)
                            placeholder = "{{ $data->rasa->nama }}"
                          @else
                            placeholder = "Rasa tidak ditemukan"
                          @endif
                        >
                      </div>
                      <div class="form-group">
                        <label>Harga</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                            <input class="form-control" placeholder="Harga" name="harga" id="harga" value="{{ $data->harga }}" onKeyPress="return goodchars(event,'0123456789',this)" disabled>
                          </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <br>
                        <label>Nama Jenis</label>
                        <input class="form-control" disabled
                          @if($data->id_jenis)
                            placeholder = "{{ $data->jenis->nama }}"
                          @else
                            placeholder = "Jenis tidak ditemukan"
                          @endif
                        >
                      </div>
                      <div class="form-group">
                        <label>Stok</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
                            <input class="form-control" placeholder="Stok" name="stok" id="stok" value="{{ $data->stok }}" onKeyPress="return goodchars(event,'0123456789',this)" disabled>
                          </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <label>Jumlah yang dihasilkan</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        <input class="form-control" placeholder="Jumlah yang dihasilkan" name="jumlahProduksi" id="jumlahProduksi" value="{{ $data->jumlah_produksi }}" disabled>
                      </div>
                    </div>
                  </div>
                
              <!-- /Form tambah es -->

              <hr id="garis">
              <ul class="nav nav-tabs-custom">
                <li class="pull-left box-header"><h3 class="box-title">Bahan baku yang diperlukan</h3></li>
              </ul>

              <!-- tabel bahan -->
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width:50px">No</th>
                        <th style="width: 325px">Nama Bahan</th>
                        <th style="width: 175px">Jumlah</th>
                      </tr>
                    </thead>
                    <tbody id="type_container">
                      <?php $no=1; ?>
                      @foreach($data->detail_bahan as $detailBahan)
                        <?php $id = $no+1; ?>
                        <tr id="tr{{$id}}">
                          <td>{{ $no++ }}</td>
                          <td>{{ $detailBahan->bahan->nama }}</td>
                          <td id="{{ $detailBahan->bahan->nama }}">{{ $detailBahan->takaran }}</td>
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