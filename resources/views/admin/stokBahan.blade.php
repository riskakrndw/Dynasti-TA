@extends('layout_master.master')

@section("title", "Stok Bahan Baku")

@section("beranda", "active")

@section("moreasset")
<link href="{{url('dist/css/bootstrap-modal-bs3patch.css')}}" rel="stylesheet" />
<link href="{{url('dist/css/bootstrap-modal.css')}}" rel="stylesheet" />

@endsection

@section("content")
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Stok Bahan Baku
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> Beranda</a></li>
        <li class="active">Stok Bahan Baku</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">       

        <div class="col-md-12">
          <a href="{{route('beranda')}}"><button type="button" class="btn btn-sm btn-primary"><i class="fa  fa-angle-double-left "></i> Kembali ke halaman beranda </button></a>
        </div>  

        <!-- Data bahan -->
        <div class="col-xs-12">
          <br>
          <div class="box">
            <!-- header -->
              <div class="box-header">
                <ul class="nav nav-tabs-custom">
                  <li class="pull-left box-header"><h3 class="box-title">Daftar Bahan</h3></li>
                </ul>
              </div>
            <!-- /header -->

            <!-- tabel bahan -->
              <div class="box-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th style="width: 30px">No</th>
                      <th style="width: 250px">Nama Bahan</th>
                      <th style="width: 110px">Satuan</th>
                      <th style="width: 100px">Stok</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; ?>
                    @foreach($data as $data)
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $data->nama }}</td>
                      <td>{{ $data->satuan }}</td>
                      <td>{{ $data->stok }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            <!-- /.tabel bahan -->

            <!-- Modal edit bahan -->
              <div id="editBahan" class="modal fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Ubah Data Bahan</h4>
                </div>
                <div class="modal-body">
                  <form role="form" action="{{url('manager/bahan/edit')}}" method="POST">
                  {{csrf_field()}}
                  <label>Nama Bahan</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-font"></i></span>
                    <input class="form-control" id="namaBahan" name="nama" placeholder="Nama Bahan" value="">
                  </div>
                  @if($errors->has('nama'))
                    <span class="help-block">Nama bahan minimal 2 karakter</span>
                  @endif
                  <br>
                  <label>Satuan</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>
                    <input class="form-control" placeholder="Satuan" id="satuanBahan" name="satuan" value="">
                  </div>
                  @if($errors->has('stok'))
                    <span class="help-block">Harus diisi</span>
                  @endif
                  <br>
                  <label>Harga</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i><b>$</b></i></span>
                    <input class="form-control" placeholder="Harga Satuan" id="hargaBahan" name="harga" type="text" onKeyPress="return goodchars(event,'0123456789',this)">
                  </div>
                  @if($errors->has('harga'))
                    <span class="help-block">Harus diisi</span>
                  @endif
                  <br>
                  <label>Stok</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
                    <input class="form-control" placeholder="Stok" id="stokBahan" name="stok" onKeyPress="return goodchars(event,'0123456789',this)">
                  </div>
                  @if($errors->has('stok'))
                    <span class="help-block">Harus diisi</span>
                  @endif
                  <input class="form-control" type="hidden" name="id" id="idBahan" value="">
                </div>
                <div class="modal-footer">
                  <button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
                  <button type="submit" class="btn btn-primary">Simpan</button>

                </div>
              </form>
              </div>
            <!-- /Modal edit bahan -->

          </div>
        </div>
        <!-- /Data bahan -->

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
      $(".btnEditBahan").click(function(){
        $('#namaBahan').val($(this).data('nama'));
        $('#satuanBahan').val($(this).data('satuan'));
        $('#hargaBahan').val($(this).data('harga'));
        $('#stokBahan').val($(this).data('stok'));
        $('#idBahan').val($(this).data('id'));
        $('#editBahan').modal('show');
      });
    });
  </script>
@endsection