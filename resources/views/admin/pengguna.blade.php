@extends('layout_master.master')

@section("title", "Manager | Pengguna")

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
            <div class="box">
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
                          <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label>Username</label>
                            <div class="input-group">
                              <span class="input-group-addon">@</span>
                              <input class="form-control" placeholder="Username" name="username" value="{{ old('username') }}">
                            </div>
                            @if ($errors->has('username'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('username') }}</strong>
                              </span>
                            @endif
                          </div>
                          <br>
                          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label>Nama</label>
                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-font"></i></span>
                              <input class="form-control" placeholder="Nama" name="name" value="{{ old('name') }}">
                            </div>
                            @if ($errors->has('name'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('name') }}</strong>
                              </span>
                            @endif
                          </div>
                          <br>
                          <div class="form-group{{ $errors->has('level') ? ' has-error' : '' }}">
                            <label>Pilih Level</label>
                            <select class="form-control select2" style="width: 100%;" name="level" id="level">
                              <option disabled="disabled" selected="selected" value="0">Pilih Level</option>
                              <option value="pengadaan" @if(old('level') == 'pengadaan') {{ 'selected' }} @endif>Bagian Pengadaan</option>
                              <option value="keuangan" @if(old('level') == 'keuangan') {{ 'selected' }} @endif>Bagian Keuangan</option>
                              <option value="produksi" @if(old('level') == 'produksi') {{ 'selected' }} @endif>Bagian Produksi</option>
                            </select>
                            @if ($errors->has('level'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('level') }}</strong>
                              </span>
                            @endif
                          </div>
                          <br>
                          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label>Kata Sandi</label>
                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-key"></i></span>
                              <input type="password" class="form-control" placeholder="Kata Sandi" name="password">
                            </div>
                            @if ($errors->has('password'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('password') }}</strong>
                              </span>
                            @endif
                          </div>
                          <br>
                          <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label>Konfirmasi Kata Sandi</label>
                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-key"></i></span>
                              <input type="password" class="form-control" placeholder="Konfirmasi Kata Sandi" name="password_confirmation">
                            </div>
                            @if ($errors->has('password_confirmation'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('password_confirmation') }}</strong>
                              </span>
                            @endif
                          </div>
                          
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
            <div class="box">

              <!-- header -->
                <div class="box-header">
                  <ul class="nav nav-tabs-custom">
                    <li class="pull-left box-header"><h3 class="box-title">Daftar Pengguna</h3></li>
                  </ul>
                </div>
              <!-- /header -->

              <!-- tabel pengguna -->
                <div class="box-body table-responsive">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Level</th>
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

                        
                          @if( $data->level == 'manager')
                            <td>
                            <div class="input-group-btn">
                              <button style="margin:10px;" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Ubah
                                <span class="fa fa-caret-down"></span></button>
                              <ul class="dropdown-menu">
                                <li><a class="btnEditPengguna" data-toggle="modal" data-id="{{$data->id}}" data-name="{{$data->name}}" data-username="{{$data->username}}" data-level="{{$data->level}}">Ubah Data Diri</a></li>
                                <li class="divider"></li>
                                <li><a class="btnEditSandi" data-toggle="modal" data-id="{{$data->id}}">Ubah Kata Sandi</a></li>
                              </ul>
                            </div>
                            </td>
                          @else
                          <td>
                            <div class="input-group-btn">
                              <button style="margin:10px;" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Ubah
                                <span class="fa fa-caret-down"></span></button>
                              <ul class="dropdown-menu">
                                <li><a class="btnEditPengguna" data-toggle="modal" data-id="{{$data->id}}" data-name="{{$data->name}}" data-username="{{$data->username}}" data-level="{{$data->level}}">Ubah Data Diri</a></li>
                                <li class="divider"></li>
                                <li><a class="btnEditSandi" data-toggle="modal" data-id="{{$data->id}}">Ubah Kata Sandi</a></li>
                              </ul>
                              <a type="button" href="{{route('hapusPengguna', ['id'=>$data->id])}}" class="btn btn-sm btn-danger btn-delete" onclick="return confirm('Apakah anda yakin akan menghapus?')"><i class="fa fa-trash-o"></i> Hapus</a>
                              </td>
                            </div>
                          @endif
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
                        <input class="form-control" id="password" type="password" placeholder="Kata Sandi Baru" name="password">
                      </div>
                      @if($errors->has('password'))
                        <span class="help-block">Nama jenis minimal 2 karakter</span>
                      @endif
                      <br>
                      <label>Ulangi Kata Sandi Baru</label>
                      <div class="input-group">
                        <span class="input-group-addon">@</span>
                        <input class="form-control" type="password" id="password_confirmation" placeholder="Konfirmasi Password" name="password_confirmation">
                      </div>
                      @if($errors->has('password_confirmation'))
                        <span class="help-block">Nama jenis minimal 2 karakter</span>
                      @endif
                      <input type="hidden" name="id" id="idPengguna1" value="">
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

    @if(count($errors->tambah) > 0)
      $('#editSandi').modal('show');
    @endif

    
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
    

    
      $(".btnEditSandi").click(function(){
        $('#idPengguna1').val($(this).data('id'));
        $('#editSandi').modal('show');
      });
    

  </script>

@endsection