@extends('layout_master.master')

@section("title", "Data Produk Pesanan")

@section("produkpesananpeng", "active")

@section("pemesananpeng", "active")

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
        <li><a href="{{route('berandapeng')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a> Pemesanan</a></li>
        <li class="active">Data Produk Pesanan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <!-- /Tambah es -->        
        <div class="col-md-12">
          <br>
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#semua" data-toggle="tab">Semua</a></li>
              <li><a href="#menunggu" data-toggle="tab">Menunggu</a></li>
              <li><a href="#siap" data-toggle="tab">Siap</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="semua">
                <div class="box-body table-responsive">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width: 20px">No</th>
                        <th style="width: 120px">Kode Pemesanan</th>
                        <th style="width: 100px">Tanggal</th>
                        <th style="width: 80px">Status</th>
                        <th style="width: 180px">Nama Ice Cream</th>
                        <th style="width: 100px">Jumlah</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                      <?php $no=1; ?>
                      @foreach($data as $data)
                        <tr>
                          <td>{{ $no++ }}</td>
                          <td>{{ $data->pemesanan->kode_pemesanan }}</td>
                          <td>{{ $data->pemesanan->tanggal }}</td>
                          <td>{{ $data->status }}</td>
                          <td>{{ $data->ice_cream->nama }}</td>
                          <td>{{ $data->jumlah }}</td>
                          <td>
                           <a href="{{ url('pengadaan/pemesanan/lihat/'.$data->pemesanan->id.'/produkpesananpeng') }}" class="btn btn-sm btn-default"><i class="fa fa-eye"></i> Lihat Detail</a>
                         </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="tab-pane" id="menunggu">
                <div class="box-body table-responsive">
                  <table id="example22" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width: 10px">No</th>
                        <th style="width: 25px">Kode Pemesanan</th>
                        <th style="width: 50px">Tanggal</th>
                        <th style="width: 80px">Nama Ice Cream</th>
                        <th style="width: 20px">Jumlah</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                      <?php $no=1; ?>
                      @foreach($datamenunggu as $data)
                        <tr>
                          <td class="number">{{ $no++ }}</td>
                          <td>{{ $data->pemesanan->kode_pemesanan }}</td>
                          <td>{{ $data->pemesanan->tanggal }}</td>
                          <td>{{ $data->ice_cream->nama }}</td>
                          <td>{{ $data->jumlah }}</td>
                          <td>
                           <a href="{{ url('pengadaan/pemesanan/lihat/'.$data->pemesanan->id.'/produkpesananpeng') }}" class="btn btn-sm btn-default"><i class="fa fa-eye"></i> Lihat Detail</a>
                           <button class="btn btn-sm btn-default btnStatusSiap" id-es="{{ $data->ice_cream->id }}" id-detail="{{ $data->id }}" jumlah="{{ $data->jumlah }}"><i class="fa fa-edit"></i> Siap</button>
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
                        <th style="width: 80px">Nama Ice Cream</th>
                        <th style="width: 20px">Jumlah</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                      <?php $no=1; ?>
                      @foreach($datasiap as $data)
                        <tr>
                          <td>{{ $no++ }}</td>
                          <td>{{ $data->pemesanan->kode_pemesanan }}</td>
                          <td>{{ $data->pemesanan->tanggal }}</td>
                          <td>{{ $data->ice_cream->nama }}</td>
                          <td>{{ $data->jumlah }}</td>
                          <td>
                           <a href="{{ url('pengadaan/pemesanan/lihat/'.$data->pemesanan->id.'/produkpesananpeng') }}" class="btn btn-sm btn-default"><i class="fa fa-eye"></i> Lihat Detail</a>
                         </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.tab-pane -->

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

    $('.btnStatusSiap').click(function(){
      if(confirm('Apakah anda akan mengubah status menjadi siap?') == true){
        var ides = $(this).attr('id-es');
        console.log(ides);
        var jumlahes = $(this).attr('jumlah');
        var iddetailpemesanan = $(this).attr('id-detail');
        var tr = $(this);
        $.ajax({
          type: "GET",
          url: "/dynasti/public/pengadaan/pemesanan/detail/siap/"+ides+"/"+jumlahes+"/"+iddetailpemesanan,
          success: function(result) {
            if(result == "tidak cukup"){
              alert("Stok tidak mencukupi");
            }else{
              toastr.success("Status berhasil diubah menjadi siap");
              tr.closest('tr').remove();
              AutoNumber();
            }
          }
        })
      }
      
    });

    function AutoNumber()
    {
      $('#example22 tbody tr').each(function (i) {
        $(this).find('.number').text(i+1);
      });
    }
  </script>

@endsection