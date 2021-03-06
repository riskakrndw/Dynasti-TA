@extends('layout_master.master')

@section("title", "Detail Data Pemesanan")

@if($tipe == "pemesanan")
  @section("pemesanan", "active")
@elseif($tipe == "produkpesanan")
  @section("pemesanan", "active")
@elseif($tipe == "pemesananpeng")
  @section("pemesananpeng", "active")
@elseif($tipe == "produkpesananpeng")
  @section("pemesananpeng", "active")
@elseif($tipe == "pemesananproduksi")
  @section("berandapro", "active")
@endif


@if($tipe == "pemesanan")
  @section("pesanan", "active")
@elseif($tipe == "produkpesanan")
  @section("produkpesanan", "active")
@elseif($tipe == "pemesananpeng")
  @section("pesananpeng", "active")
@elseif($tipe == "produkpesananpeng")
  @section("produkpesananpeng", "active")
@elseif($tipe == "pemesananberanda")
  @section("beranda", "active")
@elseif($tipe == "pemesananberandapro")
  @section("beranda", "active")
@endif


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
        @if($tipe == "pemesananberanda")
          <li><a>Beranda</a></li>
          <li><a>Informasi Pemesanan</a></li>
          <li class="active">Lihat</li>
        @elseif($tipe == "pemesananproduksi")
          <li><a>Beranda</a></li>
          <li><a>Informasi Pemesanan</a></li>
          <li class="active">Lihat</li>
        @else
          <li><a>Pemesanan</a></li>
          @if($tipe == "pemesanan")
            <li><a href="{{route('pemesanan')}}">Data Pemesanan</a></li>
          @elseif($tipe == "produkpesanan")
            <li><a href="{{route('pemesanan')}}">Data Produk Pesanan</a></li>
          @elseif($tipe == "pemesananpeng")
            <li><a href="{{route('pemesanan')}}">Data Pemesanan</a></li>
          @elseif($tipe == "produkpesananpeng")
            <li><a href="{{route('pemesanan')}}">Data Produk Pesanan</a></li>
          @endif
          <li class="active">Lihat Detail</li>
        @endif
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        @if($tipe == "pemesanan")
          <div class="col-md-12">
            <a href="{{route('pemesanan')}}"><button type="button" class="btn btn-sm btn-primary"><i class="fa  fa-angle-double-left "></i> Kembali ke halaman data pemesanan </button></a>
          </div> 
        @elseif($tipe == "produkpesanan")
          <div class="col-md-12">
            <a href="{{route('produkpesanan')}}"><button type="button" class="btn btn-sm btn-primary"><i class="fa  fa-angle-double-left "></i> Kembali ke halaman data produk pesanan </button></a>
          </div>
        @elseif($tipe == "pemesananpeng")
          <div class="col-md-12">
            <a href="{{route('pemesananpeng')}}"><button type="button" class="btn btn-sm btn-primary"><i class="fa  fa-angle-double-left "></i> Kembali ke halaman data pemesanan </button></a>
          </div>
        @elseif($tipe == "produkpesananpeng")
          <div class="col-md-12">
            <a href="{{route('produkpesananpeng')}}"><button type="button" class="btn btn-sm btn-primary"><i class="fa  fa-angle-double-left "></i> Kembali ke halaman data produk pesanan </button></a>
          </div>
        @elseif($tipe == "pemesananberanda")
          <div class="col-md-12">
            <a href="{{route('beranda')}}"><button type="button" class="btn btn-sm btn-primary"><i class="fa  fa-angle-double-left "></i> Kembali ke halaman beranda </button></a>
          </div>
        @elseif($tipe == "pemesananproduksi")
          <div class="col-md-12">
            <a href="{{route('berandapro')}}"><button type="button" class="btn btn-sm btn-primary"><i class="fa  fa-angle-double-left "></i> Kembali ke halaman beranda </button></a>
          </div>
        @endif
          
        <!-- Tambah Es -->
          <div class="col-md-12">
            <br>
            <div class="box">
              <ul class="nav nav-tabs-custom">
                <li class="pull-left box-header"><h3 class="box-title">Data Pemesanan</h3></li>
              </ul>

              <!-- Form tambah es -->
                <form role="form" action="" method="">
                  {{csrf_field()}}
                  <div class="box-body">
                    <input class="form-control" type="hidden" name="idPengguna" id="idPengguna" value="{{Auth::User()->id}}">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Kode Pemesanan</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                          <input class="form-control" placeholder="Kode Penjualan" name="kode" id="kode" value="PMS| {{\Carbon\Carbon::parse($data->tgl)->format('Y-m-d')}}| {{$data->id}}" disabled>
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
                          <input type="text" class="form-control pull-right" id="datepicker" value="{{ $data->tanggal }}" disabled>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Nama</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-font"></i></span>
                          <input class="form-control" placeholder="Nama" name="nama" id="nama" value="{{ $data->nama }}" disabled>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Telepon</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                          <input class="form-control" placeholder="Telepon" name="telepon" id="telepon" value="{{ $data->telepon }}" disabled>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Alamat</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-home"></i></span>
                          <textarea class="form-control" placeholder="Alamat" name="alamat" id="alamat" disabled> {{ $data->alamat }} </textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                
              <!-- /Form tambah es -->

              <hr id="garis">
              <ul class="nav nav-tabs-custom">
                <li class="pull-left box-header"><h3 class="box-title">Daftar Ice Cream</h3></li>
              </ul>

              <!-- tabel bahan -->
                <div class="box-body table-responsive">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width:50px">No</th>
                        <th style="width: 200px">Nama Ice Cream</th>
                        <th style="width: 175px">Harga</th>
                        <th style="width: 100px">Status</th>
                        <th style="width: 100px">Jumlah</th>
                        <th style="width: 250px">Subtotal</th>
                      </tr>
                    </thead>
                    <tbody id="type_container">
                      <?php $no=1; ?>
                      @foreach($data->detail_pemesanan as $detail_pemesanan)
                        <?php $id = $no+1; ?>
                        <tr id="tr{{$id}}">
                          <td>{{ $no++ }}</td>
                          <td>{{ $detail_pemesanan->ice_cream->nama }}</td>
                          <td>Rp {{ number_format($detail_pemesanan->ice_cream->jenis->harga,2,",","." ) }}</td>
                          <td>{{ $detail_pemesanan->status }}</td>
                          <td>{{ $detail_pemesanan->jumlah }}</td>
                          <td>Rp {{ number_format($detail_pemesanan->subtotal,2,",","." ) }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <br>

                  <span>Total Harga</span>
                  <input id="totalHarga" class="totalHarga" name="total" placeholder="0" value="Rp {{ number_format($data->total,2,",","." ) }}" disabled>

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

  <script type="text/javascript">

    $('.btnStatusSiap').click(function(){
      if(confirm('Apakah anda akan mengubah status menjadi siap?') == true){
        var ides = $(this).attr('id-es');
        console.log(ides);
        var jumlahes = $(this).attr('jumlah');
        var iddetailpemesanan = $(this).attr('id-detail');
        var tr = $(this);
        $.ajax({
          type: "GET",
          url: "/dynasti/public/manager/pemesanan/detail/siap/"+ides+"/"+jumlahes+"/"+iddetailpemesanan,
          success: function(result) {
            if(result == "tidak cukup"){
              alert("Stok tidak mencukupi");
            }else{
              toastr.success("Status berhasil diubah menjadi siap");
              tr.attr('disabled',true);
            }
          }
        })
      }
      
    });
  </script>

@endsection