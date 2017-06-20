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
                  <ul class="dropdown-menu" role="menu">
                    <li><a data-toggle="modal" data-target="#btnEditData" href="">Ubah Data</a></li>
                    <li><a data-toggle="modal" data-target="#editPass" href="">Ubah Kata Sandi</a></li>
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
                        placeholder="Bagian Manager"
                      @endif
                      " disabled>
                    </div>
                    <br>
                    <label>Email</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                      <input class="form-control" placeholder="{{Auth::user()->email}}" disabled>
                    </div>
                    <br>
                  </div>
                </form>
              <!-- /Form data pribadi -->

              <!-- Modal edit rasa -->
              <div id="btnEditData" class="modal fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Ubah Data Rasa</h4>
                </div>
                <div class="modal-body">
                  <form role="form" action="{{url('rasa/edit')}}" method="POST">
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
                      <label>Email</label>
                      <div class="input-group">
                        <span class="input-group-addon">@</span>
                        <input class="form-control" id="emailPengguna" placeholder="Email" name="email">
                      </div>
                      @if($errors->has('email'))
                        <span class="help-block">Nama jenis minimal 2 karakter</span>
                      @endif
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
      $(".btnEditData").click(function(){
        $('#namaPengguna').val($(this).data('name'));
        $('#emailPengguna').val($(this).data('email'));
        $('#idPengguna').val($(this).data('id'));
        $('#btnEditData').modal('show');
      });
    });

  </script>

@endsection