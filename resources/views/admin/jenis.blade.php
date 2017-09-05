@extends('layout_master.master')

@section("title", "Data Jenis")

@section("jenis", "active")

@section("master", "active")

@section("moreasset")
<link href="{{url('dist/css/bootstrap-modal-bs3patch.css')}}" rel="stylesheet" />
<link href="{{url('dist/css/bootstrap-modal.css')}}" rel="stylesheet" />
<!-- <link href="{{url('dist/sweetalert.css')}}" rel="stylesheet" type="text/css"/> -->

@endsection

@section("content")
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Data Jenis
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('beranda')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a > Master Data</a></li>
        <li class="active"> Data Jenis</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <!-- Tambah jenis -->
          <div class="col-md-12">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Tambah Data Jenis</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <!-- Form tambah jenis -->
                      <form role="form" action="{{url('manager/jenis/simpan')}}" method="POST" onsubmit="return Validate()" name="vform">
                        {{csrf_field()}}
                        <div class="form-group">
                          <label>Nama Jenis</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-font"></i></span>
                            <input class="form-control" placeholder="Nama Jenis" name="nama">
                          </div>
                          <span class="help-block val_error" id="nama_error" style="color:red;"></span>
                          <br>
                          <label>Harga</label>
                          <div class="input-group">
                            <span class="input-group-addon">Rp</span>
                            <input class="form-control" placeholder="Harga" name="harga" onKeyPress="return goodchars(event,'0123456789',this)">
                            <span class="input-group-addon">,00</span>
                          </div>
                          <span class="help-block val_error" id="harga_error" style="color:red;"></span>
                        </div>
                        <div class="form-group">
                          <div class="box-footer pull-right">
                            <button type="submit" class="btn btn-primary btnSimpan"><i class="fa fa-plus"> Tambah</i></button>
                          </div>
                        </div>
                      </form>
                    <!-- Form tambah jenis -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- /Tambah jenis -->

        <!-- Data jenis -->
          <div class="col-xs-12">
            <div class="box">

              <!-- header -->
                <div class="box-header">
                  <ul class="nav nav-tabs-custom">
                    <li class="pull-left box-header"><h3 class="box-title">Daftar Jenis</h3></li>
                  </ul>
                </div>
              <!-- /header -->

              <!-- tabel jenis -->
                <div class="box-body table-responsive">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width: 50px">No</th>
                        <th style="width: 500px">Nama Jenis</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no=1; ?>
                      @foreach($data as $data)
                      <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>Rp {{ number_format($data->harga,2,",","." ) }}</td>
                        <td>
                          <button type="button" class="btn btn-sm btn-default btnEditJenis" data-toggle="modal" data-target="" data-id="{{ $data->id }}" data-nama="{{ $data->nama }}" data-harga="{{ $data->harga }}"> <i class="fa fa-edit"></i> Ubah</button>
                          <a type="button" href="{{route('hapusJenis', ['id'=>$data->id])}}" class="btn btn-sm btn-danger btn-delete" onclick="return confirm('Apakah anda yakin akan menghapus?')"><i class="fa fa-trash-o"></i> Hapus</button>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              <!-- /.tabel jenis -->

              <!-- Modal edit jenis -->
                <div id="editJenis" class="modal fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Ubah Data Jenis</h4>
                  </div>
                  <div class="modal-body modal-primary">
                    <form role="form" action="{{url('manager/jenis/edit')}}" method="POST">
                    {{csrf_field()}}
                    <label>Nama Jenis</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-font"></i></span>
                      <input class="form-control" id="namaJenis" name="nama" placeholder="Nama Jenis" value="">
                    </div>
                    <br>
                    <label>Harga</label>
                    <div class="input-group">
                      <span class="input-group-addon">Rp</span>
                      <input class="form-control" id="hargaJenis" name="harga" placeholder="Harga" value="" onKeyPress="return goodchars(event,'0123456789',this)">
                      <span class="input-group-addon">,00</span>
                    </div>
                    <input class="form-control" type="hidden" name="id" id="idJenis" value="">
                  </div>
                  <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>

                  </div>
                </form>
                </div>
              <!-- /Modal edit jenis -->
            </div>
          </div>
        <!-- /Data jenis -->

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
<!--   
  <script src="{{url('dist/sweetalert.min.js')}}"></script>  
 -->
<!-- validasi keyboard numeric only -->
  <script src="{{url('dist/js/validasinumeric.js')}}"></script>

  <script type="text/javascript">

    //getting all input object
      var nama = document.forms["vform"]["nama"];
      var harga = document.forms["vform"]["harga"];

    //getting all error display object
      var nama_error = document.getElementById("nama_error");
      var harga_error = document.getElementById("harga_error");

    //setting all event listener
      nama.addEventListener("blur", namaVerify, true);
      harga.addEventListener("blur", hargaVerify, true);

    //validation function
      function Validate(){
        var cek = false;
        
        if(nama.value == ""){
          nama.style.border = "1px solid red";
          nama_error.textContent = "Nama harus diisi";
          nama.focus();
          return false;
        }else{
          nama.style.border = "1px solid #5E6E66";
          nama_error.textContent = "";
        }

        if(harga.value == ""){
          harga.style.border = "1px solid red";
          harga_error.textContent = "Harga harus diisi";
          harga.focus();
          return false;
        }else{
          harga.style.border = "1px solid #5E6E66";
          harga_error.textContent = "";
        }

      }
  </script>

  <script type="text/javascript">

    $(document).ready(function(){
      $(".btnEditJenis").click(function(){
        $('#hargaJenis').val($(this).data('harga'));
        $('#namaJenis').val($(this).data('nama'));
        $('#idJenis').val($(this).data('id'));
        $('#editJenis').modal('show');
      });
    });

  </script>

@endsection