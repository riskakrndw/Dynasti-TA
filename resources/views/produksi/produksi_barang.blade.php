@extends('layout_master.master')

@section("title", "Bagian Produksi | Data Produk Produksi")

@section("produksipro", "active")

@section("produkproduksipro", "active")

@section("moreasset")
<link href="{{url('dist/css/bootstrap-modal-bs3patch.css')}}" rel="stylesheet" />
<link href="{{url('dist/css/bootstrap-modal.css')}}" rel="stylesheet" />

@endsection

@section("content")
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Data Produk Produksi
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('berandapro')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Produk Produksi</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">      

        <!-- Data produksi -->
        <div class="col-xs-12">
          <br>
          <div class="box">
            <!-- header -->
              <div class="box-header">
                <ul class="nav nav-tabs-custom">
                  <li class="pull-left box-header"><h3 class="box-title">Daftar Produk Produksi</h3></li>
                </ul>
              </div>
            <!-- /header -->

            <!-- tabel produksi -->
              <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th style="width: 10px">No</th>
                      <th style="width: 125px">Kode Produksi</th>
                      <th style="width: 150px">Tanggal</th>
                      <th style="width: 350px">Nama Ice Cream</th>
                      <th style="width: 100px">Jumlah</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; ?>
                    @foreach($data as $data)
                      @if($data->jumlah > 0)
                        <tr>
                          <td>{{ $no++ }}</td>
                          <td>PRO| {{\Carbon\Carbon::parse($data->tgl)->format('Y-m-d')}}| {{$data->id}}</td>
                          <td>{{ $data->produksi->tgl }}</td>
                          <td>{{ $data->ice_cream->nama }}</td>
                          <td>{{ $data->jumlah }}</td>
                          <td>
                            <a href="{{ url('produksi/produksi/lihat/'.$data->produksi->id.'/produkproduksi') }}" class="btn btn-sm btn-default btnLihatBahan"><i class="fa fa-eye"></i> Lihat Detail</a>
                          </td>
                        </tr>
                      @endif
                    @endforeach
                  </tbody>
                </table>
              </div>
            <!-- /.tabel produksi -->

          </div>
        </div>
        <!-- /Data produksi -->



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

@endsection