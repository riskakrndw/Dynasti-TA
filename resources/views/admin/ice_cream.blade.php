@extends('layout_master.master')

@section("title", "Ice Cream")

@section("es", "active")

@section("master", "active")

@section("moreasset")
<link href="{{url('dist/css/bootstrap-modal-bs3patch.css')}}" rel="stylesheet" />
<link href="{{url('dist/css/bootstrap-modal.css')}}" rel="stylesheet" />

@endsection

@section("content")
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Data Ice Cream
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> Data Master</a></li>
        <li class="active">Ice Cream</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <!-- Tambah es -->
          <div class="col-md-12">
            <a href="{{route('tambahEs')}}"><button type="button" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Ice Cream </button></a>
          </div>
        <!-- /Tambah es -->        

        <!-- Data es -->
        <div class="col-xs-12">
          <br>
          <div class="box box-success">
            <!-- header -->
              <div class="box-header">
                <ul class="nav nav-tabs-custom">
                  <li class="pull-left box-header"><h3 class="box-title">Daftar Ice Cream</h3></li>
                </ul>
              </div>
            <!-- /header -->

            <!-- tabel es -->
              <div class="box-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th style="width: 10px">No</th>
                      <th style="width: 300px">Nama Ice Cream</th>
                      <!-- <th style="width: 100px">Rasa</th>
                      <th style="width: 100px">Jenis</th> -->
                      <th style="width: 150px">Harga</th>
                      <th style="width: 100px">Stok</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; ?>
                    @foreach($data as $data)
                    <tr>
                      
                      <td>{{ $no++ }}</td>
                      <td>{{ $data->nama }}</td>

                     <!--  @if($data->id_rasa)
                        <td>{{ $data->rasa->nama }}</td>
                      @else
                        <td>Rasa tidak ditemukan</td>
                      @endif

                      @if($data->id_jenis) 
                        <td>{{ $data->jenis->nama }}</td>
                      @else
                        <td>Jenis tidak ditemukan</td>
                      @endif -->

                      <td>{{ $data->harga }}</td>
                      <td>{{ $data->stok }}</td>
                      <td>
                        <a href="{{ url('icecream/lihat/'.$data->id) }}" class="btn btn-sm btn-default btnLihatBahan"><i class="fa fa-eye"></i> Lihat Detail</a>
                        <a href="{{ url('icecream/edit/'.$data->id) }}" class="btn btn-sm btn-default btnEditEs"><i class="fa fa-edit"></i> Ubah</a>
                        <a type="button" href="{{route('hapusIceCream', ['id'=>$data->id])}}" class="btn btn-sm btn-danger btn-delete" onclick="return confirm('Apakah anda yakin akan menghapus?')"><i class="fa fa-trash-o"></i> Hapus</button>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            <!-- /.tabel es -->

          </div>
        </div>
        <!-- /Data es -->



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