@extends('layout_master.master')



@if($tipe == "dataproduksipro")
  @section("title", "Bagian Produksi | Detail Data Produksi")
@elseif($tipe == "produkproduksipro")
  @section("title", "Bagian Produksi | Detail Data Produk Produksi")
@endif

@if($tipe == "dataproduksipro")
  @section("dataproduksipro", "active")
@elseif($tipe == "produkproduksipro")
  @section("produkproduksipro", "active")
@endif

@section("produksipro", "active")

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
        @if($tipe == "dataproduksipro")
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Data Produksi</a></li>
          <li class="active">Detail</li>
        @elseif($tipe == "produkproduksipro")
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Data Produk Produksi</a></li>
          <li class="active">Detail</li>
        @endif
        
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        @if($tipe == "dataproduksipro")
          <div class="col-md-12">
            <a href="{{route('produksiPro')}}"><button type="button" class="btn btn-sm btn-primary"><i class="fa  fa-angle-double-left "></i> Kembali ke halaman data produksi </button></a>
          </div> 
        @elseif($tipe == "produkproduksipro")
          <div class="col-md-12">
            <a href="{{route('produkproduksiPro')}}"><button type="button" class="btn btn-sm btn-primary"><i class="fa  fa-angle-double-left "></i> Kembali ke halaman data produk produksi </button></a>
          </div>
        @endif

        <!-- Tambah penjualan -->
          <div class="col-md-12">
            <br>
            <div class="box">
              <ul class="nav nav-tabs-custom">
                <li class="pull-left box-header"><h3 class="box-title">Data Produksi</h3></li>
              </ul>

              <!-- Form tambah penjualan -->
                <form role="form" action="" method="">
                  {{csrf_field()}}
                  <div class="box-body">
                    <input type="hidden" name="idPengguna" id="idPengguna" value="{{ Auth::User()->id }}">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Kode Produksi</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                          <input class="form-control" placeholder="Kode Produksi" name="kode" id="kode" value="PRO| {{\Carbon\Carbon::parse($data->tgl)->format('Y-m-d')}}| {{$data->id}}" disabled>
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
                          <input type="text" class="form-control pull-right" id="datepicker" name="datepicker" value="{{ $data->tgl }}" disabled>
                        </div>
                      </div>
                    </div>
                    <input type="hidden" name="ides" id="ides" value="{{ $data->detail_produksi[0]->ice_cream->id }}">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Rasa</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-font"></i></span>
                          <input type="text" class="form-control" id="rasa" name="rasa" value="{{$data->detail_produksi[0]->ice_cream->rasa->nama}}" value="" disabled>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <br>
                        <label>Jumlah produksi </label><br>
                        <?php
                          $no = 1;
                        ?>
                        @foreach($data->detail_produksi as $key=>$datadetail)
                        <label>{{$no++}} . {{$datadetail->ice_cream->jenis->nama}}</label>
                        <br>
                        Jumlah ice cream yang diproduksi:
                        <input class="form-control bb" jmlproduksi="{{ $datadetail->ice_cream->jumlah_produksi }}" placeholder="Jumlah Produksi" name="jumlah" min="0" value="{{$datadetail->jumlah}}" id="jumlahPro{{$key+1}}" ides="datadetail->id_es" disabled>
                        <br>
                        @endforeach
                      </div>
                    </div>
                  </div>
                
              <!-- /Form tambah penjualan -->

              <hr id="garis">
              <ul class="nav nav-tabs-custom">
                <li class="pull-left box-header"><h3 class="box-title">Daftar Bahan Baku</h3></li>
              </ul>

                <div class="box-body table-responsive">
                  
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width:50px">No</th>
                        <th style="width: 250px">Nama Bahan</th>
                        <th style="width: 200px">Satuan</th>
                        <th style="width: 250px">Jumlah</th>
                        <th>Stok</th>
                      </tr>
                    </thead>
                    <tbody id="type_container">
                      <?php $no=1; ?>
                      @foreach($data->detail_produksi[0]->ice_cream->rasa->detail_rasa as $detailBahan)
                      <?php
                        $id = $data->id;
                      ?>
                          <tr id="{{$id}}">
                            <td>{{ $no++ }}</td>
                            <td>{{ $detailBahan->bahan->nama }}</td>
                            <td>{{ $detailBahan->bahan->satuan }}</td>
                            <td class="total">{{ $detailBahan->takaran }}</td>
                            <td>{{ $detailBahan->bahan->stok }}</td>
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
        <!-- /Tambah penjualan -->
        
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

  <!-- script tambah bahan baku -->
 
@endsection