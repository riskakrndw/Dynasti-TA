@extends('layout_master.master')

@section("title", "Profil")

@section("moreasset")
<link href="{{url('dist/css/bootstrap-modal-bs3patch.css')}}" rel="stylesheet" />
<link href="{{url('dist/css/bootstrap-modal.css')}}" rel="stylesheet" />

@endsection

@section("content")
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Profil Pengguna
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Profil Pengguna</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <!-- Data Pribadi -->
        <div class="col-md-2"></div>
          <div class="col-md-8">
            <div class="box box-success">
              <ul class="nav nav-tabs-custom">
                <li class="pull-left box-header"><h3 class="box-title">Data Pribadi</h3></li>
                <div class="btn-group pull-right">
                  <li type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                    <span class="fa fa-gear"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </li>
                  <ul class="dropdown-menu">
                    <li><a class="btnEditPengguna" data-toggle="modal" data-id="{{Auth::user()->id}}" data-name="{{Auth::user()->name}}" data-username="{{Auth::user()->username}}">Ubah Data Diri</a></li>
                    <li class="divider"></li>
                    <li><a class="btnEditSandi" data-toggle="modal" data-target="" >Ubah Kata Sandi</a></li>
                  </ul>
                </div>
              </ul>

              <!-- Form data pribadi -->
                <form role="form">
                  <div class="box-body">
                    <label>Nama</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-font"></i></span>
                      <input class="form-control" placeholder="{{Auth::user()->name}}" disabled>
                    </div>
                    <br>
                    <label>Level</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input class="form-control"
                      @if(Auth::user()->level == "manager")
                        placeholder="Manager"
                      @endif
                      " disabled>
                    </div>
                    <br>
                    <label>Username</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                      <input class="form-control" placeholder="{{Auth::user()->username}}" disabled>
                    </div>
                    <br>
                  </div>
                </form>
              <!-- /Form data pribadi -->

              <!-- Modal edit pengguna -->
                <div id="editPengguna" class="modal fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Ubah Data Pengguna</h4>
                  </div>
                  <div class="modal-body modal-primary">
                    <form role="form" action="{{url('manager/profil/edit')}}" method="POST">
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
                    <form role="form" action="{{url('manager/profil/editSandi')}}" method="POST">
                      {{csrf_field()}}
                      <label>Kata Sandi Lama</label>
                      <div class="input-group">
                        <span class="input-group-addon">@</span>
                        <input class="form-control" id="sandiLama" type="password" placeholder="Kata Sandi Lama" name="sandiLama">
                      </div>
                      @if($errors->has('username'))
                        <span class="help-block">Nama jenis minimal 2 karakter</span>
                      @endif
                      <br>
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
                        <input class="form-control" type="password" id="ulangSandiBaru" placeholder="Ulangi Kata Sandi Baru" name="ulangSandiBaru">
                      </div>
                      @if($errors->has('username'))
                        <span class="help-block">Nama jenis minimal 2 karakter</span>
                      @endif
                      <input class="form-control" type="hidden" name="id" id="idPengguna1" value="">
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
        <!-- /Data Pribadi -->

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
        $('#usernamePengguna').val($(this).data('username'));
        $('#idPengguna').val($(this).data('id'));
        $('#editPengguna').modal('show');
      });
    });

    $(document).ready(function(){
      $(".btnEditSandi").click(function(){
        $('#idPengguna1').val($(this).data('id'));
        $('#editSandi').modal('show');
      });
    });

  </script>

@endsection