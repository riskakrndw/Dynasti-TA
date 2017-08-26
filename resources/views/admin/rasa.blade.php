@extends('layout_master.master')

@section("title", "Data Rasa")

@section("rasa", "active")

@section("master", "active")

@section("moreasset")
<link href="{{url('dist/css/bootstrap-modal-bs3patch.css')}}" rel="stylesheet" />
<link href="{{url('dist/css/bootstrap-modal.css')}}" rel="stylesheet" />
@endsection

@section("content")
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Data Rasa
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('beranda')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a> Master Data</a></li>
        <li class="active"> Data Rasa</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <!-- Tambah jenis -->
          <div class="col-md-12">
            <a href="{{route('tambahRasa')}}"><button type="button" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Rasa </button></a>
          </div>
        <!-- /Tambah rasa -->

        <!-- Data rasa -->
          <div class="col-xs-12">
            <br>
            <div class="box">

              <!-- header -->
                <div class="box-header">
                  <ul class="nav nav-tabs-custom">
                    <li class="pull-left box-header"><h3 class="box-title">Daftar Rasa</h3></li>
                  </ul>
                </div>
              <!-- /header -->

              <!-- tabel rasa -->
                <div class="box-body table-responsive">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width: 50px">No</th>
                        <th style="width: 500px">Nama Rasa</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no=1; ?>
                      @foreach($data as $data)
                      <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>
                          <a href="{{ url('manager/rasa/lihat/'.$data->id) }}" class="btn btn-sm btn-default btnLihatBahan"><i class="fa fa-eye"></i> Lihat Detail</a>
                          <a type="button" href="{{ url('manager/rasa/edit/'.$data->id) }}" class="btn btn-sm btn-default"> <i class="fa fa-edit"></i> Ubah</a>
                          <a type="button" href="{{route('hapusRasa', ['id'=>$data->id])}}" class="btn btn-sm btn-danger btn-delete" onclick="return confirm('Apakah anda yakin akan menghapus?')"><i class="fa fa-trash-o"></i> Hapus</button>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              <!-- /.tabel rasa -->

              <!-- Modal edit rasa -->
                <div id="editRasa" class="modal fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Ubah Data Rasa</h4>
                  </div>
                  <div class="modal-body modal-primary">
                    <form role="form" action="{{url('manager/rasa/edit')}}" method="POST">
                    {{csrf_field()}}
                    <label>Nama Rasa</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-font"></i></span>
                      <input class="form-control" id="namaRasa" name="nama" placeholder="Nama Rasa" value="">
                    </div>
                    <input class="form-control" type="hidden" name="id" id="idRasa" value="">
                  </div>
                  <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>

                  </div>
                </form>
                </div>
              <!-- /Modal edit rasa -->

            </div>
          </div>
        <!-- /Data rasa -->

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

@endsection