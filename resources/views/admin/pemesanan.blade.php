@extends('layout_master.master')

@section("title", "Data Pemesanan")

@section("pesanan", "active")

@section("pemesanan", "active")

@section("moreasset")
<link href="{{url('dist/css/bootstrap-modal-bs3patch.css')}}" rel="stylesheet" />
<link href="{{url('dist/css/bootstrap-modal.css')}}" rel="stylesheet" />

@endsection

@section("content")
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Data Produk Pesanan
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> Transaksi</a></li>
        <li class="active">Data Pemesanan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <!-- Tambah es -->
          <div class="col-md-12">
            <a href="{{route('tambahPemesanan')}}"><button type="button" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Pengadaan </button></a>
          </div>

        <!-- /Tambah es -->        
        <div class="col-md-12">
          <br>
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#semua" data-toggle="tab">Semua</a></li>
              <li><a href="#menunggu" data-toggle="tab">Menunggu</a></li>
              <li><a href="#siap" data-toggle="tab">Siap</a></li>
              <li><a href="#selesai" data-toggle="tab">Selesai</a></li>
              <li><a href="#batal" data-toggle="tab">Batal</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="semua">
                <div class="box-body table-responsive">
                  <table id="example21" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width: 20px">No</th>
                        <th style="width: 110px">Kode Pemesanan</th>
                        <th style="width: 70px">Tanggal</th>
                        <th style="width: 80px">Status</th>
                        <th style="width: 108px">Nama</th>
                        <th style="width: 148px">Alamat</th>
                        <th style="width: 76px">Total</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                      <?php $no=1; ?>
                      @foreach($data as $data)
                        <tr>
                          <td>{{ $no++ }}</td>
                          <td>{{ $data->kode_pemesanan }}</td>
                          <td>{{ $data->tanggal }}</td>
                          <td>{{ $data->status }}</td>
                          <td>{{ $data->nama }}</td>
                          <td>{{ $data->alamat }}</td>
                          <td>{{ $data->total }}</td>
                          <td>
                           <a href="{{ url('manager/pemesanan/lihat/'.$data->id.'/pemesanan') }}" class="btn btn-sm btn-default"><i class="fa fa-eye"></i> Lihat Detail</a>
                           <a href="{{ url('manager/pemesanan/edit/'.$data->id) }}" class="btn btn-sm btn-default btnEditEs"><i class="fa fa-edit"></i> Ubah</a>
                         </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>

              <!-- /.tab-pane -->
              <div class="tab-pane" id="menunggu">
                <div class="box-body table-responsive">
                  <table id="example22" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width: 10px">No</th>
                        <th style="width: 25px">Kode Pemesanan</th>
                        <th style="width: 50px">Tanggal</th>
                        <th style="width: 50px">Nama</th>
                        <th style="width: 75px">Alamat</th>
                        <th style="width: 30px">Total</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                      <?php $no=1; ?>
                      @foreach($datamenunggu as $data)
                        <tr>
                          <td>{{ $no++ }}</td>
                          <td>{{ $data->kode_pemesanan }}</td>
                          <td>{{ $data->tanggal }}</td>
                          <td>{{ $data->nama }}</td>
                          <td>{{ $data->alamat }}</td>
                          <td>{{ $data->total }}</td>
                          <td>
                           <a href="{{ url('manager/pemesanan/lihat/'.$data->id.'/pemesanan') }}" class="btn btn-sm btn-default"><i class="fa fa-eye"></i> Lihat Detail</a>
                         </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="siap">
                <div class="box-body table-responsive">
                  <table id="example23" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width: 10px">No</th>
                        <th style="width: 25px">Kode Pemesanan</th>
                        <th style="width: 50px">Tanggal</th>
                        <th style="width: 50px">Nama</th>
                        <th style="width: 75px">Alamat</th>
                        <th style="width: 30px">Total</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                      <?php $no=1; ?>
                      @foreach($datasiap as $data)
                        <tr>
                          <td>{{ $no++ }}</td>
                          <td>{{ $data->kode_pemesanan }}</td>
                          <td>{{ $data->tanggal }}</td>
                          <td>{{ $data->nama }}</td>
                          <td>{{ $data->alamat }}</td>
                          <td>{{ $data->total }}</td>
                          <td>
                           <a href="{{ url('manager/pemesanan/lihat/'.$data->id.'/pemesanan') }}" class="btn btn-sm btn-default"><i class="fa fa-eye"></i> Lihat Detail</a>
                           <button class="btn btn-sm btn-default btnStatusSelesai" id-pemesanan="{{ $data->id }}"><i class="fa fa-edit"></i> Selesai</button>
                         </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="selesai">
                <div class="box-body table-responsive">
                  <table id="example24" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width: 10px">No</th>
                        <th style="width: 50px">Kode Pemesanan</th>
                        <th style="width: 50px">Tanggal</th>
                        <th style="width: 75px">Nama</th>
                        <th style="width: 50px">Alamat</th>
                        <th style="width: 50px">Total</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                      <?php $no=1; ?>
                      @foreach($dataselesai as $data)
                        <tr>
                          <td>{{ $no++ }}</td>
                          <td>{{ $data->kode_pemesanan }}</td>
                          <td>{{ $data->tanggal }}</td>
                          <td>{{ $data->nama }}</td>
                          <td>{{ $data->alamat }}</td>
                          <td>{{ $data->total }}</td>
                          <td>
                           <a href="{{ url('manager/pemesanan/lihat/'.$data->id.'/pemesanan') }}" class="btn btn-sm btn-default"><i class="fa fa-eye"></i> Lihat Detail</a>
                         </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="tab-pane" id="batal">
                <div class="box-body table-responsive">
                  <table id="example25" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width: 10px">No</th>
                        <th style="width: 25px">Kode Pemesanan</th>
                        <th style="width: 50px">Tanggal</th>
                        <th style="width: 50px">Nama</th>
                        <th style="width: 75px">Alamat</th>
                        <th style="width: 30px">Total</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                      <?php $no=1; ?>
                      @foreach($databatal as $datas)
                        <tr>
                          <td>{{ $no++ }}</td>
                          <td>{{ $datas->kode_pemesanan }}</td>
                          <td>{{ $datas->tanggal }}</td>
                          <td>{{ $datas->nama }}</td>
                          <td>{{ $datas->alamat }}</td>
                          <td>{{ $datas->total }}</td>
                          <td>
                           <a href="{{ url('manager/pemesanan/lihat/'.$datas->id.'/pemesanan') }}" class="btn btn-sm btn-default"><i class="fa fa-eye"></i> Lihat Detail</a>
                         </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>

            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>

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
  <script src="{{url('dist/js/validasinumeric.js')}}"></script>

  <script type="text/javascript">

    $('.btnStatusSelesai').click(function(){
      var tr = $(this);
      if(confirm('Apakah anda akan mengubah status menjadi selesai?') == true){
        var idpesanan = $(this).attr('id-pemesanan');
        $.ajax({
          type: "GET",
          url: "/dynasti/public/manager/pemesanan/selesai/"+idpesanan,
          success: function(result) {
            toastr.success("Status berhasil diubah menjadi siap");
            tr.closest('tr').remove();
          }
        })
      }
      
    });
  </script>

@endsection