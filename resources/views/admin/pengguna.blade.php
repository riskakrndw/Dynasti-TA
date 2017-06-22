@extends('layout_master.master')

@section("title", "Pengguna")

@section("user", "active")

@section("moreasset")
<link href="{{url('dist/css/bootstrap-modal-bs3patch.css')}}" rel="stylesheet" />
<link href="{{url('dist/css/bootstrap-modal.css')}}" rel="stylesheet" />
@endsection

@section("content")
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Data Pengguna
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Pengguna</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <!-- Tambah pengguna -->
          <div class="col-md-12">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Tambah Data Pengguna</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <!-- Form tambah pengguna -->
                      <form role="form" action="{{route('tambahPengguna')}}" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                          <label>Username</label>
                          <div class="input-group">
                            <span class="input-group-addon">@</span>
                            <input class="form-control" placeholder="Username" name="username">
                          </div>
                          @if($errors->has('username'))
                            <span class="help-block">Nama jenis minimal 2 karakter</span>
                          @endif
                          <br>
                          <label>Nama</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-font"></i></span>
                            <input class="form-control" placeholder="Nama" name="name">
                          </div>
                          @if($errors->has('name'))
                            <span class="help-block">Nama jenis minimal 2 karakter</span>
                          @endif
                          <br>
                          <label>Pilih Level</label>
                          <select class="form-control select2" style="width: 100%;" name="level" id="level">
                            <option disabled="disabled" selected="selected" value="0">Pilih Level</option>
                            <option value="pengadaan">Bagian Pengadaan</option>
                            <option value="keuangan">Bagian Keuangan</option>
                            <option value="produksi">Bagian Produksi</option>
                            
                          </select>
                          <br>
                          <label>Password</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input type="password" class="form-control" placeholder="Password" name="password">
                          </div>
                          @if($errors->has('password'))
                            <span class="help-block">Nama jenis minimal 2 karakter</span>
                          @endif
                        </div>
                        <div class="form-group">
                          <div class="box-footer pull-right">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                          </div>
                        </div>
                      </form>
                    <!-- Form tambah pengguna -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- /Tambah pengguna -->

        <!-- Data pengguna -->
          <div class="col-xs-12">
            <div class="box box-success">

              <!-- header -->
                <div class="box-header">
                  <ul class="nav nav-tabs-custom">
                    <li class="pull-left box-header"><h3 class="box-title">Daftar Pengguna</h3></li>
                  </ul>
                </div>
              <!-- /header -->

              <!-- tabel pengguna -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="width: 50px">No</th>
                        <th style="width: 250px">Nama</th>
                        <th style="width: 100px">Username</th>
                        <th style="width: 150px">Level</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no=1; ?>
                      @foreach($data as $data)
                      <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->username }}</td>
                        @if($data->level == 'manager')
                          <td>Manager</td>
                        @elseif($data->level == 'produksi')
                          <td>Bagian Produksi</td>
                        @elseif($data->level == 'keuangan')
                          <td>Bagian Keuangan</td>
                        @elseif($data->level == 'pengadaan')
                          <td>Bagian Pengadaan</td>
                        @endif

                        <td>
                          @if( $data->level == 'manager')
                            <div class="input-group-btn">
                              <button style="margin:10px;" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Ubah
                                <span class="fa fa-caret-down"></span></button>
                              <ul class="dropdown-menu">
                                <li><a class="btnEditPengguna" data-toggle="modal" data-target="" data-id="{{$data->id}}" data-name="{{$data->name}}" data-username="{{$data->username}}" data-level="{{$data->level}}">Ubah Data Diri</a></li>
                                <li class="divider"></li>
                                <li><a class="btnEditSandi" data-toggle="modal" data-target="" data-password="{{$data->password}}">Ubah Kata Sandi</a></li>
                              </ul>
                            </div>
                          @else  
                            <div class="input-group-btn">
                              <button style="margin:10px;" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Ubah
                                <span class="fa fa-caret-down"></span></button>
                              <ul class="dropdown-menu">
                                <li><a class="btnEditPengguna" data-toggle="modal" data-target="" data-id="{{$data->id}}" data-name="{{$data->name}}" data-username="{{$data->username}}" data-level="{{$data->level}}">Ubah Data Diri</a></li>
                                <li class="divider"></li>
                                <li><a class="btnEditSandi" data-toggle="modal" data-target="" data-password="{{$data->password}}">Ubah Kata Sandi</a></li>
                              </ul>
                              <a type="button" href="{{route('hapusPengguna', ['id'=>$data->id])}}" class="btn btn-sm btn-danger btn-delete" onclick="return confirm('Apakah anda yakin akan menghapus?')"><i class="fa fa-trash-o"></i> Hapus</a>
                            </div>
                          @endif
                          
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              <!-- /.tabel pengguna -->

              <!-- Modal edit pengguna -->
                <div id="editPengguna" class="modal fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Ubah Data Pengguna</h4>
                  </div>
                  <div class="modal-body modal-primary">
                    <form role="form" action="{{url('manager/pengguna/edit')}}" method="POST">
                      {{csrf_field()}}
                      <label>Nama</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        <input class="form-control" id="namaPengguna" placeholder="Nama" name="name">
                      </div>
                      @if($errors->has('name'))
                        <span class="help-block">Nama jenis minimal 2 karakter</span>
                      @endif
                      <br>
                      <label>Pilih Level</label>
                      <input class="form-control" id="levelManager" name="level" disabled>
                      <select class="form-control select2" style="width: 100%;" name="level" id="levelPengguna">
                        <option disabled="disabled" selected="selected" value="0">Pilih Level</option>
                        <option value="pengadaan">Bagian Pengadaan</option>
                        <option value="keuangan">Bagian Keuangan</option>
                        <option value="produksi">Bagian Produksi</option>      
                      </select>
                      <br>
                      <label>Username</label>
                      <div class="input-group">
                        <span class="input-group-addon">@</span>
                        <input class="form-control" id="usernamePengguna" placeholder="Username" name="username">
                      </div>
                      @if($errors->has('username'))
                        <span class="help-block">Nama jenis minimal 2 karakter</span>
                      @endif
                      <input class="form-control" type="hidden" name="id" id="idPengguna" value="">
                    </div>
                    <div class="modal-footer">
                      <button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                  </form>
                </div>
              <!-- </div> -->
            <!-- /Modal edit pengguna -->

            <!-- Modal edit kata sandi -->
                <div id="editSandi" class="modal fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Ubah Kata Sandi</h4>
                  </div>
                  <div class="modal-body modal-primary">
                    <form role="form" action="{{url('manager/pengguna/editSandi')}}" method="POST">
                      {{csrf_field()}}
                      <label>Kata Sandi Baru</label>
                      <div class="input-group">
                        <span class="input-group-addon">@</span>
                        <input class="form-control" id="sandiBaru" type="password" placeholder="Kata Sandi Baru" name="sandiBaru">
                      </div>
                      @if($errors->has('username'))
                        <span class="help-block">Nama jenis minimal 2 karakter</span>
                      @endif
                      <br>
                      <label>Ulangi Kata Sandi Baru</label>
                      <div class="input-group">
                        <span class="input-group-addon">@</span>
                        <input class="form-control" type="password" id="ulangSandiBaru" placeholder="Email" name="ulangSandiBaru">
                      </div>
                      @if($errors->has('username'))
                        <span class="help-block">Nama jenis minimal 2 karakter</span>
                      @endif
                      <input class="form-control" type="hidden" name="id" id="idPengguna" value="">
                    </div>
                    <div class="modal-footer">
                      <button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                  </form>
                </div>
              <!-- </div> -->
            <!-- /Modal edit kata sandi -->

            </div>
          </div>
        <!-- /Data pengguna -->

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

  <script type="text/javascript">
    $(document).ready(function(){
      $(".btnEditPengguna").click(function(){
        $('#namaPengguna').val($(this).data('name'));
        if($(this).data('level')=="manager"){
          $('#levelManager').val($(this).data('level'));
          $('#levelManager').show();
          $('#levelPengguna').hide();
        }
        else{
        $('#levelPengguna').val($(this).data('level'));
        $('#levelPengguna').show();
        $('#levelManager').hide();
        }
        $('#usernamePengguna').val($(this).data('username'));
        $('#idPengguna').val($(this).data('id'));
        $('#editPengguna').modal('show');
      });
    });

    $(document).ready(function(){
      $(".btnEditSandi").click(function(){
        
        $('#editSandi').modal('show');
      });
    });

  </script>

@endsection