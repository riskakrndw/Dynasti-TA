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
        <li><a href="#"> Master Data</a></li>
        <li class="active">Ice Cream</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">     

        <!-- Data es -->
        <div class="col-xs-12">
          <div class="box box-success">
            <!-- header -->
              <div class="box-header">
                <ul class="nav nav-tabs-custom">
                  <li class="pull-left box-header"><h3 class="box-title">Daftar Ice Cream</h3></li>
                </ul>
              </div>
            <!-- /header -->

            <!-- tabel es -->
              <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th style="width: 10px">No</th>
                      <th style="width: 300px">Nama Ice Cream</th>
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

                      <td>{{ $data->jenis->harga }}</td>
                      <td>{{ $data->stok }}</td>
                      <td> 
                        <button type="button" class="btn btn-sm btn-default btnEditStok" data-toggle="modal" data-target="" data-id="{{ $data->id }}" data-stok="{{ $data->stok }}"> <i class="fa fa-edit"></i> Ubah Stok</button>
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

        <!-- Modal edit stok -->
          <div id="editStok" class="modal fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Ubah Data Jenis</h4>
            </div>
            <div class="modal-body modal-primary">
              <form role="form" action="{{url('manager/icecream/edit')}}" method="POST">
              {{csrf_field()}}
              <label>Stok</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-font"></i></span>
                <input class="form-control" id="stok" name="stok" placeholder="Stok" value="">
              </div>
              <input class="form-control" type="hidden" name="id" id="idEs" value="">
            </div>
            <div class="modal-footer">
              <button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
              <button type="submit" class="btn btn-primary">Simpan</button>

            </div>
          </form>
          </div>
        <!-- /Modal edit stok -->

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
    $(document).ready(function(){
      $(".btnEditStok").click(function(){
        $('#hargaJenis').val($(this).data('harga'));
        $('#stok').val($(this).data('stok'));
        $('#idEs').val($(this).data('id'));
        $('#editStok').modal('show');
      });
    });

  </script>

@endsection