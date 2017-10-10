@extends('layout_master.master')

@section("title", "Manager | Data Bahan Baku")

@section("bahan", "active")

@section("master", "active")

@section("moreasset")
<link href="{{url('dist/css/bootstrap-modal-bs3patch.css')}}" rel="stylesheet" />
<link href="{{url('dist/css/bootstrap-modal.css')}}" rel="stylesheet" />

@endsection

@section("content")
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Data Bahan Baku
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('beranda')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a> Master Data</a></li>
        <li class="active">Data Bahan Baku</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">       

        <!-- Tambah Jenis -->
          <div class="col-md-12">
            <br>
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Tambah Data Bahan Baku</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
              </div>
              <!-- Form tambah jenis -->
                <form role="form" action="{{url('manager/bahan/simpan')}}" method="POST" id="formID" onsubmit="return Validate()" name="vform">
                  {{csrf_field()}}
                  <div class="box-body">
                    <div class="col-md-12">
                      <div class="form-group">
                        <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                          <label>Nama Bahan</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-font"></i></span>
                            <input class="form-control" placeholder="Nama Bahan" name="nama" value="{{ old('nama') }}">
                          </div>
                          @if ($errors->has('nama'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nama') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="form-group{{ $errors->has('satuan') ? ' has-error' : '' }}">
                          <label>Satuan</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>
                            <input class="form-control" placeholder="Satuan" name="satuan" value="{{ old('satuan') }}">
                          </div>
                          @if ($errors->has('satuan'))
                            <span class="help-block">
                                <strong>{{ $errors->first('satuan') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="form-group{{ $errors->has('harga') ? ' has-error' : '' }}">
                          <label>Harga Satuan</label>
                          <div class="input-group">
                            <span class="input-group-addon">Rp</span>
                            <input class="form-control" placeholder="Harga Satuan" name="harga" type="text" value="{{ old('harga') }}" onKeyPress="return goodchars(event,'0123456789',this)">
                            <span class="input-group-addon">,00</span>
                          </div>
                          @if ($errors->has('harga'))
                            <span class="help-block">
                                <strong>{{ $errors->first('harga') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="form-group{{ $errors->has('stok') ? ' has-error' : '' }}">
                          <label>Stok</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
                            <input class="form-control" placeholder="Stok" name="stok" value="{{ old('stok') }}" onKeyPress="return goodchars(event,'0123456789',this)">
                          </div>
                          @if ($errors->has('stok'))
                            <span class="help-block">
                                <strong>{{ $errors->first('stok') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="form-group{{ $errors->has('stok_min') ? ' has-error' : '' }}">
                          <label>Stok Minimal</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
                            <input class="form-control" placeholder="Stok Minimal" name="stok_min" value="{{ old('stok_min') }}" onKeyPress="return goodchars(event,'0123456789',this)">
                          </div>
                          @if ($errors->has('stok_min'))
                            <span class="help-block">
                                <strong>{{ $errors->first('stok_min') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="box-footer pull-right">
                      <br>
                      <button type="submit" class="btn btn-primary"><i class="fa fa-plus"> Tambah</i></button>
                    </div>
                  </div>
                </form>
              <!-- /Form tambah jenis -->
            </div>
          </div>
        <!-- /Tambah jenis -->

        <!-- Data bahan -->
        <div class="col-xs-12">
          <div class="box">

            <!-- header -->
              <div class="box-header">
                <ul class="nav nav-tabs-custom">
                  <li class="pull-left box-header"><h3 class="box-title">Daftar Bahan</h3></li>
                </ul>
              </div>
            <!-- /header -->

            <!-- tabel bahan -->
              <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Bahan</th>
                      <th>Satuan</th>
                      <th>Harga Satuan</th>
                      <th>Stok</th>
                      <th>Stok Minimal</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; ?>
                    @foreach($data as $data)
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $data->nama }}</td>
                      <td>{{ $data->satuan }}</td>
                      <td>Rp {{ number_format($data->harga,2,",","." ) }}</td>
                      <td>{{ $data->stok }}</td>
                      <td>{{ $data->stok_min }}</td>
                      <td>
                        <button type="button" class="btn btn-sm btn-default btnEditBahan" data-toggle="modal" data-target="" data-id="{{$data->id}}" data-nama="{{$data->nama}}" data-satuan="{{$data->satuan}}" data-harga="{{$data->harga}}" data-stok="{{$data->stok}}" data-stokmin="{{$data->stok_min}}"><i class="fa fa-edit"></i> Ubah</button>
                        <a type="button" href="{{route('hapusBahan', ['id'=>$data->id])}}" class="btn btn-sm btn-danger btn-delete" onclick="return confirm('Apakah anda yakin akan menghapus?')"><i class="fa fa-trash-o"></i> Hapus</button>
                      </td>
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
                  <div class="form-group{{ $errors->has('namaUbah') ? ' has-error' : '' }}">
                    <label>Nama Bahan</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-font"></i></span>
                      <input class="form-control" id="namaBahan" name="namaUbah" placeholder="Nama Bahan" value="{{ old('namaUbah') }}">
                    </div>
                    @if ($errors->has('namaUbah'))
                      <span class="help-block">
                          <strong>{{ $errors->first('namaUbah') }}</strong>
                      </span>
                    @endif
                  </div>
                  <br>
                  <div class="form-group{{ $errors->has('satuanUbah') ? ' has-error' : '' }}">
                    <label>Satuan</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>
                      <input class="form-control" placeholder="Satuan" id="satuanBahan" name="satuanUbah" value="{{ old('satuanUbah') }}">
                    </div>
                    @if ($errors->has('satuanUbah'))
                      <span class="help-block">
                          <strong>{{ $errors->first('satuanUbah') }}</strong>
                      </span>
                    @endif
                  </div>
                  <br>
                  <div class="form-group{{ $errors->has('hargaUbah') ? ' has-error' : '' }}">
                    <label>Harga Satuan</label>
                    <div class="input-group">
                      <span class="input-group-addon">Rp</span>
                      <input class="form-control" placeholder="Harga Satuan" id="hargaBahan" value="{{ old('hargaUbah') }}" name="hargaUbah" type="text" onKeyPress="return goodchars(event,'0123456789',this)">
                      <span class="input-group-addon">,00</span>
                    </div>
                    @if ($errors->has('hargaUbah'))
                      <span class="help-block">
                          <strong>{{ $errors->first('hargaUbah') }}</strong>
                      </span>
                    @endif
                  </div>
                  <br>
                  <div class="form-group{{ $errors->has('stokUbah') ? ' has-error' : '' }}">
                    <label>Stok</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
                      <input class="form-control" placeholder="Stok" id="stokBahan" value="{{ old('stokUbah') }}" name="stokUbah" onKeyPress="return goodchars(event,'0123456789',this)">
                    </div>
                    @if ($errors->has('stokUbah'))
                      <span class="help-block">
                          <strong>{{ $errors->first('stokUbah') }}</strong>
                      </span>
                    @endif
                  </div>
                  <br>
                  <div class="form-group{{ $errors->has('stok_minUbah') ? ' has-error' : '' }}">
                    <label>Stok Minimal</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
                      <input class="form-control" placeholder="Stok Minimal" value="{{ old('stok_minUbah') }}" id="stok_min" name="stok_minUbah" onKeyPress="return goodchars(event,'0123456789',this)">
                    </div>
                    @if ($errors->has('stok_minUbah'))
                      <span class="help-block">
                          <strong>{{ $errors->first('stok_minUbah') }}</strong>
                      </span>
                    @endif
                  </div>
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
    
    @if(count($errors)>0)
      @if ($errors->has('namaUbah') || $errors->has('hargaUbah') || $errors->has('satuanUbah') || $errors->has('stokUbah') || $errors->has('stok_minUbah'))
        $('#editBahan').modal('show');
      @endif
      
    @endif

      $(".btnEditBahan").click(function(){
        $('#namaBahan').val($(this).data('nama'));
        $('#satuanBahan').val($(this).data('satuan'));
        $('#hargaBahan').val($(this).data('harga'));
        $('#stokBahan').val($(this).data('stok'));
        $('#stok_min').val($(this).data('stokmin'));
        $('#idBahan').val($(this).data('id'));
        $('#editBahan').modal('show');
      });
    
  </script>
@endsection