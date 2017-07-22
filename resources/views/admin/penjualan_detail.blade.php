@extends('layout_master.master')

@section("title", "Detail Penjualan")

@section("jual", "active")

@section("transaksi", "active")

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
        <li><a href="#"> Transaksi</a></li>
        <li><a href="#">Data Penjualan</a></li>
        <li class="active">Lihat Detail</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        
        <div class="col-md-12">
          <a href="{{route('penjualan')}}"><button type="button" class="btn btn-sm btn-primary"><i class="fa  fa-angle-double-left "></i> Kembali ke halaman data penjualan </button></a>
        </div>   

        <!-- Tambah jual -->
          <div class="col-md-12">
            <br>
            <div class="box box-success">
              <ul class="nav nav-tabs-custom">
                <li class="pull-left box-header"><h3 class="box-title">Data Penjualan</h3></li>
              </ul>

              <!-- Form tambah jual -->
                <form role="form" action="" method="">
                  {{csrf_field()}}
                  <div class="box-body">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Kode Penjualan</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-font"></i></span>
                          <input class="form-control" placeholder="Kode Penjualan" name="kode" id="kode" value="{{ $data->kode_penjualan }}" disabled>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Tanggal</label>
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" class="form-control pull-right" id="datepicker" value="{{ $data->tgl }}" disabled>
                        </div>
                      </div>
                    </div>
                  </div>
                
              <!-- /Form tambah jual -->

              <hr id="garis">
              <ul class="nav nav-tabs-custom">
                <li class="pull-left box-header"><h3 class="box-title">Daftar ice cream yang dijual</h3></li>
              </ul>

              <!-- tabel es -->
                <div class="box-body table-responsive">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width:50px">No</th>
                        <th style="width: 200px">Nama Ice Cream</th>
                        <th style="width: 175px">Harga</th>
                        <th style="width: 100px">Jumlah</th>
                        <th style="width: 250px">Subtotal</th>
                      </tr>
                    </thead>
                    <tbody id="type_container">
                      <?php $no=1; ?>
                      @foreach($data->detail_jual as $detail_jual)
                        <?php $id = $no+1; ?>
                        <tr id="tr{{$id}}">
                          <td>{{ $no++ }}</td>
                          <td>{{ $detail_jual->ice_cream->nama }}</td>
                          <td>{{ $detail_jual->ice_cream->jenis->harga }}</td>
                          <td id="{{ $detail_jual->ice_cream->nama }}">{{ $detail_jual->jumlah }}</td>
                          <td class="subTotal">{{ $detail_jual->subtotal }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <br>

                  <span>Total Harga</span>
                  <input id="totalHarga" class="totalHarga" name="total" placeholder="0" value="{{ $data->total }}" disabled>

                </div>
              <!-- /.tabel es -->
            </div>
          </div>
          </form>
        <!-- /Tambah jual -->
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