@extends('layout_master.master')

@section("title", "Data Pengadaan")

@section("pembelianPeng", "active")

@section("moreasset")
<link href="{{url('dist/css/bootstrap-modal-bs3patch.css')}}" rel="stylesheet" />
<link href="{{url('dist/css/bootstrap-modal.css')}}" rel="stylesheet" />

@endsection

@section("content")
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Data Permintaan Pengadaan
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Permintaan Pengadaan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <!-- Data es -->
        <div class="col-xs-12">
          <br>
          <div class="box box-success">
            <!-- header -->
              <div class="box-header">
                <ul class="nav nav-tabs-custom">
                  <li class="pull-left box-header"><h3 class="box-title">Daftar Permintaan Pengadaan</h3></li>
                </ul>
              </div>
            <!-- /header -->

            <!-- tabel es -->
              <div class="box-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th style="width: 10px">No</th>
                      <th style="width: 200px">Kode Pengadaan</th>
                      <th style="width: 200px">Tanggal</th>
                      <th style="width: 200px">Total</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; ?>
                    @foreach($data as $data)
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $data->kode_pembelian }}</td>
                      <td>{{ $data->tgl }}</td>
                      <td>{{ $data->total }}</td>
                      <td>
                        <a href="{{ url('manager/konfirmasi/lihat/'.$data->id) }}" class="btn btn-sm btn-default btnLihatBahan"><i class="fa fa-eye"></i> Lihat Detail</a>
                        <form method="post" action="{{ url('manager/konfirmasi/ubah') }}">
                          {{csrf_field()}}
                          <input class="form-control" type="hidden" name="id" id="id" value="{{ $data->id }}">
                          <input class="form-control" type="hidden" name="status" value="berhasil">
                          <button type="submit" class="btn btn-sm btn-default btnEditEs"><i class="fa fa-check"></i> Terima</button>
                        </form>
                        <form method="post" action="{{ url('manager/konfirmasi/ubah') }}">
                          {{csrf_field()}}
                          <input class="form-control" type="hidden" name="id" id="id" value="{{ $data->id }}">
                          <input class="form-control" type="hidden" name="status" value="gagal">
                          <button type="submit" class="btn btn-sm btn-default btnEditEs"><i class="fa fa-remove"></i> Tolak</button>
                        </form>
                        <!-- <a type="button" href="{{route('hapusPembelian', ['id'=>$data->id])}}" class="btn btn-sm btn-danger btn-delete" onclick="return confirm('Apakah anda yakin akan menghapus?')"><i class="fa fa-trash-o"></i> Hapus</button> -->
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