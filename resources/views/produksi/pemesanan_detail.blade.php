@extends('layout_master.master')

@section("title", "Bagian Produksi | Informasi Pemesanan")

@section("berandapro", "active")

@section("content")

  <div class="content-wrapper">
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="{{route('beranda')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a>Beranda</a></li>
        <li><a>Informasi Pemesanan</a></li>
        <li class="active">Lihat</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <div class="col-md-12">
          <a href="{{route('berandapro')}}"><button type="button" class="btn btn-sm btn-primary"><i class="fa  fa-angle-double-left "></i> Kembali ke beranda </button></a>
        </div> 
          
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
                          <input class="form-control" placeholder="Kode Penjualan" name="kode" id="kode" value="{{ $data->kode_pemesanan }}" disabled>
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